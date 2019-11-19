<?php

namespace App\Teams;


class Roles
{
	public static $roles = [
		'team_admin' => [
			'name' => 'Admin',
			'permissions' => [
				'view team dashboard',
				'manage team subscription',
				'delete team',
				'delete user',
				'change user role',
				'add users'
			]
		],

		'team_member' => [
			'name' => 'Memeber',
			'permissions' => [
				'view team dashboard'
			]
		]

	];
}