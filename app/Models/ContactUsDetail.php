<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsDetail extends Model
{
    protected $table = 'contact_us_details';
    protected $guarded = [];

    protected $casts = [
        'career_coach_points' => 'array',
        'hero_trust_points' => 'array',
        'form_trust_points' => 'array',
        'why_contact_cards' => 'array',
    ];

    /**
     * Resolves maps.app.goo.gl and goo.gl/maps short URLs to direct embed URLs
     */
    public function getEmbedMapUrlAttribute()
    {
        $url = $this->map_embed_url;
        
        if (empty($url)) {
            return 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.2223849502847!2d76.76450637684824!3d30.726224385966398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed160a000001%3A0x63334dc2809e53b1!2sSector%2034%2C%20Chandigarh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';
        }

        if (str_contains($url, 'embed') || str_contains($url, 'pb=')) {
            return $url;
        }

        if (str_contains($url, 'maps.app.goo.gl') || str_contains($url, 'goo.gl/maps')) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                $response = curl_exec($ch);
                
                preg_match('/^Location:\s+(.*)$/mi', $response, $matches);
                curl_close($ch);
                
                if (!empty($matches[1])) {
                    $url = trim($matches[1]);
                }
            } catch (\Exception $e) {
                // Fallback to address or current URL
            }
        }

        if (str_contains($url, 'google.com/maps') || str_contains($url, 'google.co.in/maps')) {
            if (preg_match('/\/place\/([^\/]+)/', $url, $placeMatches)) {
                return "https://maps.google.com/maps?q=" . urlencode(urldecode($placeMatches[1])) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
            }
            if (preg_match('/\/@([0-9.-]+),([0-9.-]+)/', $url, $coordMatches)) {
                return "https://maps.google.com/maps?q=" . $coordMatches[1] . "," . $coordMatches[2] . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
            }
        }

        return "https://maps.google.com/maps?q=" . urlencode($url) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
    }
}
