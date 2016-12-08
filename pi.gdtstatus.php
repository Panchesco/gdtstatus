<?php

/**
 * Good at Statuses	
 *
 * @package       Good at Statuses
 * @author         Richard Whitmer
 * @copyright      Copyright (c) 2016, Richard Whitmer
 * @link           https://github.com/panchesco/gdtstatus
 * @license        MIT
 * @version        1.2.4
 * @filesource     gdtstatus/plugin.gdtstatus.php
 */

class Gdtstatus 
{
	
		public $return_data = '';
		
			/**
			 * Make status group/s and statuses available in the templates.
			 *
			*/
			public function group() 
			{
				
				$data		= array();
				$group_id 	= ee()->TMPL->fetch_param('group_id',FALSE);
				$group_name 	= ee()->TMPL->fetch_param('group_name',FALSE);
				$group_sort 	= ee()->TMPL->fetch_param('group_sort','ASC');
				$status_sort 	= ee()->TMPL->fetch_param('status_sort','ASC');
				$exclude 		= ee()->TMPL->fetch_param('exclude');
				$separator	= ee()->TMPL->fetch_param('separator',"-");
				$limit		= ee()->TMPL->fetch_param('limit',100);
				
				
				if($group_id !== FALSE || $group_name !== FALSE)
				{
					$statuses = ee('Model')
						->get('Status as s')
						->with('StatusGroup as sg')
						->limit($limit)
						->fields('sg.group_name',
								'status',
								'status_order',
								'highlight')
						->orFilter('sg.group_id','IN',explode('|',$group_id))
						->orFilter('sg.group_name','IN',explode('|',$group_name))
						->filter('s.status','NOT IN',explode('|',$exclude))
						->order('sg.group_name',$group_sort)
						->order('s.status_order',$status_sort)
						->all();
				
				} else {
					return '';
				}
				
				
				foreach($statuses as $status)
				{
					$group = $status->StatusGroup;
					
					$data[] = array(

									'group_id'	=> $group->group_id,
									'group_name'	=> $group->group_name,
									'site_id'		=> $group->site_id,
									'status'		=> $status->status,
									'slug'		=> preg_replace("/[^[:alnum:]-_]/",$separator,strtolower($status->status)),
									'status_order'	=> $status->status_order,
									'highlight'	=> $status->highlight
					);
				}
				
				
				return ee()->TMPL->parse_variables(ee()->TMPL->tagdata,$data);	

			}
				
			//-----------------------------------------------//
			
			/**
			 * Returns string with underscores and dashes replaced with white space.
			 *
			*/
			public function unslug() 
			{
				$separator	= ee()->TMPL->fetch_param('separator',"-");
				
				if(ee()->TMPL->fetch_param('slug')) 
				{
					return str_replace($separator,' ',ee()->TMPL->fetch_param('slug')); 
				} else {
					return str_replace($separator,' ',ee()->TMPL->tagdata); 
				}	
			}
				
			//-----------------------------------------------//
}
//End
