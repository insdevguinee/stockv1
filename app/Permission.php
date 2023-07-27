<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{

	public static function getModels()
	{
		return ['access_admin','users','materiels','categories','entres','stocks','roles','permissions','tickets','chantiers','home','notifications','sorties','settings','transferts','bons','fournisseurs','sortiemultiple','entremultiple','outils','assignations','personnels','rapports','boncaisses'];
	}

	public static function defaultPermissions()
	{
	    		return [
	    			'access_admin',
	    			'view_home',
	    			'view_notifications',

		    		'view_users',
			        'add_users',
			        'edit_users',
			        'delete_users',

			        'view_materiels',
			        'add_materiels',
			        'edit_materiels',
			        'delete_materiels',

			        'view_categories',
			        'add_categories',
			        'edit_categories',
			        'delete_categories',

			        'view_entres',
			        'add_entres',
			        'edit_entres',
			        'delete_entres',
			        'download_entres',

			        'view_sorties',
			        'add_sorties',
			        'edit_sorties',
			        'delete_sorties',
			        'download_sorties',

			        'view_sortiemultiple',
			        'add_sortiemultiple',
			        'edit_sortiemultiple',
			        'delete_sortiemultiple',

			        'view_entremultiple',
			        'add_entremultiple',
			        'edit_entremultiple',
			        'delete_entremultiple',

			        'view_categories',
			        'add_categories',
			        'edit_categories',
			        'delete_categories',

			        'view_tickets',
			        'add_tickets',
			        'edit_tickets',
			        'delete_tickets',

			        'view_stocks',
			        'add_stocks',
			        'edit_stocks',
			        'delete_stocks',
			        'download_stocks',

			        'view_roles',
			        'add_roles',
			        'edit_roles',
			        'delete_roles',

			        'view_permissions',
			        'add_permissions',
			        'edit_permissions',
			        'delete_permissions',

			        'view_chantiers',
			        'add_chantiers',
			        'edit_chantiers',
			        'delete_chantiers',


			        'view_settings',
			        'add_settings',
			        'edit_settings',
			        'delete_settings',

			        'view_transferts',
			        'add_transferts',
			        'edit_transferts',
			        'delete_transferts',

			        'view_bons',
			        'add_bons',
			        'edit_bons',
			        'delete_bons',
			        'download_bons',
			        'valide_bons',

					'view_boncaisses',
			        'add_boncaisses',
			        'edit_boncaisses',
			        'delete_boncaisses',
			        'download_boncaisses',
			        'valide_boncaisses',

			        'view_fournisseurs',
			        'add_fournisseurs',
			        'edit_fournisseurs',
			        'delete_fournisseurs',

			        'view_outils',
			        'add_outils',
			        'edit_outils',
			        'delete_outils',

			        'view_assignations',
			        'add_assignations',
			        'edit_assignations',
			        'delete_assignations',

			        'view_personnels',
			        'add_personnels',
			        'edit_personnels',
			        'delete_personnels',

			        'view_rapports',
			        'add_rapports',
			        'edit_rapports',
			        'delete_rapports',
			        'valide_rapports',

                    'view_fiches',
			        'add_fiches',
			        'edit_fiches',
			        'delete_fiches',
			        'valide_fiches'
		     ];
	}
}
