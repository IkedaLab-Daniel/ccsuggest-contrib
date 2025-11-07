<?php
// app/Models/User.php
namespace App\Models;

use App\Notifications\SendVerificationCode;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   public function profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function surveyResponse()
    {
        return $this->hasOne(UserSurveyResponse::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }

    //roles()
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relationship with email verification codes
     */
    public function verificationCodes()
    {
        return $this->hasMany(EmailVerificationCode::class);
    }

    /**
     * Send the email verification code notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        // Delete any existing unused codes
        $this->verificationCodes()->where('is_used', false)->delete();

        // Generate new code
        $code = EmailVerificationCode::generateCode();

        // Store the code in database
        $this->verificationCodes()->create([
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
            'is_used' => false,
        ]);

        // Send the notification
        $this->notify(new SendVerificationCode($code));
    }
}

