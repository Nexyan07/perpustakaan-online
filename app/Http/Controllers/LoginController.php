<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Coba autentikasi
        if (Auth::attempt($request->only('name', 'password'), $request->has('remember'))) {
            // Jika berhasil login
            $request->session()->regenerate(); // Mencegah session fixation attack
            
            return Auth::user()->role === 'admin'
            ? redirect()->intended('/admin')->with('login', true)
            : redirect()->intended('/')->with('login', true);
        }

        // Jika gagal login
        return back()->withErrors([
            'name' => 'Name atau password salah.',
        ])->withInput($request->only('name', 'remember'));
    }

    /**
     * Tangani logout pengguna.
     */
    public function logout(Request $request)
    {
        try {

            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            foreach ($_COOKIE as $key => $value) {
                if(strpos($key, 'remember_web') === 0) {
                    Cookie::queue(Cookie::forget('$key'));
                }
            }
            
            return redirect('/')->with('success', 'Logout berhasil!');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function validateOldPasswordPage()
    {
        return view('validate_old_password');
    }

    public function validateOldPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:8',
        ]);

        if (password_verify($request->old_password, Auth::user()->password)) {
            return redirect()->route('change.password');
        }

        return back()->withErrors([
            'old_password' => 'Password lama salah.',
        ]);
    }

    public function changePasswordPage()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect('profile')->with('status', 'success')->with('message', 'Password berhasil di ganti');
    }

    public function destroyFoto()
    {
        $user = User::find(Auth::id());
        $user->update([
            'foto' => 'default-profile.jpg',
        ]);

        return redirect('profile')->with('status', 'success')->with('message', 'Foto berhasil dihapus');
    }

    public function fixImageOrientation($image, $path)
    {
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($path);
            if ($exif && isset($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3: // Rotasi 180 derajat
                        $image = imagerotate($image, 180, 0);
                        break;
                    case 6: // Rotasi 90 derajat ke kanan
                        $image = imagerotate($image, -90, 0);
                        break;
                    case 8: // Rotasi 90 derajat ke kiri
                        $image = imagerotate($image, 90, 0);
                        break;
                }
            }
        }
        return $image;
    }


    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('foto') | $request->has('fotoDefault')) {
            // hapus gambar lama
            if ($user->foto && file_exists(public_path('img/users/' . $user->foto)) && $user->foto !== 'default-profile.jpg') {
                unlink(public_path('img/users/' . $user->foto));
            }

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $path = $foto->getRealPath();
                
                // Create a GD image resource from the file path
                $imageResource = imagecreatefromstring(file_get_contents($path));
                if ($imageResource === false) {
                    // Handle error
                    throw new \Exception('Failed to create image resource.');
                }

                // Fix image orientation
                $imageFix = $this->fixImageOrientation($imageResource, $path);

                // Crop the image to 1:1
                $width = imagesx($imageFix);
                $height = imagesy($imageFix);
                $minSize = min($width, $height);
                $x = ($width - $minSize) / 2;
                $y = ($height - $minSize) / 2;
                
                $croppedImage = imagecrop($imageFix, ['x' => $x, 'y' => $y, 'width' => $minSize, 'height' => $minSize]);
                if ($croppedImage === false) {
                    // Handle error
                    throw new \Exception('Failed to crop image.');
                }

                    $croppedImage = imagescale($croppedImage, 600, 600);
                    if ($croppedImage === false) {
                        // Handle error
                        throw new \Exception('Failed to resize image.');
                    }

                // simpan gambar baru
                $originalName = $foto->getClientOriginalName();
                $fotoName = time() . '_' . $originalName;
                $user->foto = $fotoName; //simpan foto ke database

                // Save the cropped image as PNG
                $imagePath = public_path('img/users/' . $fotoName);
                imagepng($croppedImage, $imagePath);


                // Free up memory
                imagedestroy($imageResource);
                imagedestroy($croppedImage);
            } elseif ($request->has('fotoDefault')) {
                $user->foto = $request->fotoDefault;
            } else {
                $user->foto = $user->foto;
            }
        }
        
        $user->update([
            'name' => request('name'),
            'address' => request('address'),
            'telepon' => request('telepon'),
            'email' => request('email'),
        ]);

        return redirect('profile');
    }
}