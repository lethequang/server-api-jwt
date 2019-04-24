<?php

namespace App\Http\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

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
		'remember_token',
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

	public function remove($user) {
		return $user->delete();
	}

	public function edit($user, $data) {
		$this->formatInputs($user, $data);
		return $user->update($data);
	}

	public function formatInputs($user, &$data) {
		if ($data['password'] == $user->password) {
			unset($data['password']);
		} else {
			$data['password'] = Hash::make($data['password']);
		}
		return $data;
	}

	public function add($data) {
		$this->formatInputs($this, $data);
		return $this->create($data);
	}
}
