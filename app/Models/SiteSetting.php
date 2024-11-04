<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    // Các trường có thể được gán giá trị hàng loạt (mass-assignable)
    protected $fillable = [
        'website_logo',
        'site_name',
        'brand_name',
        'slogan',
        'phone',
        'email',
        'headquarters',
        'business_license',
        'working_hours',
        'facebook_link',
        'youtube_link',
        'instagram_link',
        'privacy_policy_url',
        'terms_of_service_url',
        'introduction',
        'copyright',
    ];

    // Định nghĩa các giá trị mặc định
    public static function defaultSettings()
    {
        return [
            'website_logo' => 'theme/client/images/Logo_Poly_Cinemas.png',
            'site_name' => 'Website Đặt Vé Xem Phim Poly Cinemas',
            'brand_name' => 'Công Ty Phim Việt Nam Poly Cinemas',
            'slogan' => 'Hãy đặt vé Xem phim ngay!',
            'phone' => '0123456789',
            'email' => 'polycinemas@poly.cenimas',
            'headquarters' => 'Tòa nhà FPT Polytechnic, Phố Trịnh Văn Bô, Nam Từ Liêm, Hà Nội',
            'business_license' => '123456789',
            'working_hours' => '7:00 - 22:00',
            'facebook_link' => 'https://facebook.com/',
            'youtube_link' => 'https://youtube.com/',
            'instagram_link' => 'https://instagram.com/',
            'privacy_policy_url' => 'Link Chính sách bảo mật',
            'terms_of_service_url' => 'Link Điều khoản Dịch vụ',
            'introduction' => 'Giới thiệu về website đặt vé xem phim Poly Cinemas...',
            'copyright' => 'Bản quyền © 2024 Poly Cinemas',
        ];
    }

    // Phương thức đặt lại cài đặt về mặc định
    public function resetToDefault()
    {
        $this->update(self::defaultSettings());
    }
}
