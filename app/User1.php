<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User1 extends Authenticatable implements JWTSubject
{
    use Notifiable;

	// Rest omitted for brevity

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}

	protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'phone', 'full_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function showAllUser($filters) {
		$sql = $this->select('*');

		if (isset($filters['email'])) {
			$email = $filters['email'];
			$sql->where('users.email', 'LIKE', '%'. $email .'%');
		}

		if (isset($filters['phone'])) {
			$email = $filters['phone'];
			$sql->where('users.phone', 'LIKE', '%'. $email .'%');
		}

		if (isset($filters['full_name'])) {
			$email = $filters['full_name'];
			$sql->where('users.full_name', 'LIKE', '%'. $email .'%');
		}

		$total = $sql->count();

		$data = $sql->skip($filters['offset'])
			->take($filters['limit'])
			->orderBy($filters['sort'], $filters['order'])
			->get()
			->toArray();

		return [
			'total' => $total,
			'rows' => $data
		];
	}

	public function removeUser($user) {
    	return $user->delete();
	}

	public function edit($user, $data) {
		return $user->update($data);
	}

	public function create($data) {
    	$object = new User1();
    	return $object->create($data);
	}
}
