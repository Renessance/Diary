<?php

return [

	'' => [
	'controller' => 'main',
		'action' => 'index',
	],

	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],

	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],

	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],

	'main/child' => [
		'controller' => 'main',
		'action' => 'child',
	],

	'main/mother' => [
		'controller' => 'main',
		'action' => 'mother',
	],

	'main/father' => [
		'controller' => 'main',
		'action' => 'father',
	],

	'main/edit/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'edit',
	],

	'main/show/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'show',
	],

	'main/delete/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'delete',
	],

	'admin/adminList' => [
		'controller' => 'admin',
		'action' => 'adminList',
	],

	'admin/adminList{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'adminList',
	],

	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],

	'admin/create' => [
		'controller' => 'admin',
		'action' => 'create',
	],
	'admin/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'edit',
	],

	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

	'admin/controlUser' => [
		'controller' => 'admin',
		'action' => 'controlUser',
	],
	'admin/controlUser/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'controlUser',
	],

	'admin/deleteUser/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'deleteUser',
	],

	'admin/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'delete',
	],

	'admin/show/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'show',
	],

];