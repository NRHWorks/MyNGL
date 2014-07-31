<?php
/**
 * @file
 * myngl_content_type.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function myngl_content_type_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_activities|node|myngl|form';
  $field_group->group_name = 'group_activities';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Activities',
    'weight' => '10',
    'children' => array(
      0 => 'field_activity_room_activity',
      1 => 'field_activity_room_message',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-activities field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_activities|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_assets|node|myngl|form';
  $field_group->group_name = 'group_assets';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Assets',
    'weight' => '7',
    'children' => array(
      0 => 'field_audio',
      1 => 'field_welcome_video',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-assets field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_assets|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_contact|field_collection_item|field_myngl_invitees|form';
  $field_group->group_name = 'group_contact';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_myngl_invitees';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Contact Info',
    'weight' => '0',
    'children' => array(
      0 => 'field_invitee_first_name',
      1 => 'field_invitee_last_name',
      2 => 'field_invitee_email_address',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-contact field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_contact|field_collection_item|field_myngl_invitees|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_copy|node|myngl|form';
  $field_group->group_name = 'group_copy';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Copy',
    'weight' => '4',
    'children' => array(
      0 => 'field_myngl_description',
      1 => 'field_myngl_invitation_email',
      2 => 'field_myngl_sponsor',
      3 => 'field_twitter_canned_message',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-copy field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_copy|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_dates|node|myngl|form';
  $field_group->group_name = 'group_dates';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Dates',
    'weight' => '3',
    'children' => array(
      0 => 'field_myngl_dates',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-dates field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_dates|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_gifting_series_ex_site|node|myngl|form';
  $field_group->group_name = 'group_gifting_series_ex_site';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = 'group_gifting';
  $field_group->data = array(
    'label' => 'Gifting Series External Site',
    'weight' => '49',
    'children' => array(
      0 => 'field_external_site_title',
      1 => 'field_external_site_subtitle',
      2 => 'field_external_site_description',
      3 => 'field_external_site_link',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-gifting-series-ex-site field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_gifting_series_ex_site|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_gifting|node|myngl|form';
  $field_group->group_name = 'group_gifting';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Gifting',
    'weight' => '12',
    'children' => array(
      0 => 'field_reward',
      1 => 'field_gifting_series_background',
      2 => 'field_gifting_series_bottom_righ',
      3 => 'field_reward_congrats_image',
      4 => 'group_gifting_series_ex_site',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-gifting field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_gifting|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_in_progress|node|myngl|form';
  $field_group->group_name = 'group_in_progress';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'In Progress',
    'weight' => '5',
    'children' => array(
      0 => 'field_myngl_message',
      1 => 'group_pov',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-in-progress field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_in_progress|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_myngl_invitees|node|myngl|form';
  $field_group->group_name = 'group_myngl_invitees';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Invitees',
    'weight' => '8',
    'children' => array(
      0 => 'field_myngl_invitees',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-myngl-invitees field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_myngl_invitees|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_myngl|field_collection_item|field_myngl_invitees|form';
  $field_group->group_name = 'group_myngl';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_myngl_invitees';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Myngl Info',
    'weight' => '3',
    'children' => array(
      0 => 'field_invitee_status',
      1 => 'field_invitee_rsvp_date',
      2 => 'field_myngl_tagline',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-myngl field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_myngl|field_collection_item|field_myngl_invitees|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_points|node|myngl|form';
  $field_group->group_name = 'group_points';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Points',
    'weight' => '11',
    'children' => array(
      0 => 'field_points_for_visiting_social',
      1 => 'field_points_for_visiting_theate',
      2 => 'field_points_for_visiting_activi',
      3 => 'field_points_for_visiting_lobby',
      4 => 'field_points_for_playroom_activi',
      5 => 'field_points_for_sending_ct_msg',
      6 => 'field_points_for_opening_ugc_win',
      7 => 'field_points_for_opening_pov_win',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-points field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_points|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_pov|node|myngl|form';
  $field_group->group_name = 'group_pov';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = 'group_in_progress';
  $field_group->data = array(
    'label' => 'POV',
    'weight' => '8',
    'children' => array(
      0 => 'field_pov_question',
      1 => 'field_pov_question_suggestions',
      2 => 'field_pov_messages',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-pov field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_pov|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_questions|field_collection_item|field_myngl_invitees|form';
  $field_group->group_name = 'group_questions';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_myngl_invitees';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Questions',
    'weight' => '5',
    'children' => array(
      0 => 'field_pre_question_answers',
      1 => 'field_post_question_answer',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-questions field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_questions|field_collection_item|field_myngl_invitees|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_questions|node|myngl|form';
  $field_group->group_name = 'group_questions';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Questions',
    'weight' => '6',
    'children' => array(
      0 => 'field_pre_myngl_questions',
      1 => 'field_post_myngl_questions',
      2 => 'field_lounge_other_filter_title',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-questions field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_questions|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_theater|node|myngl|form';
  $field_group->group_name = 'group_theater';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'myngl';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Theater',
    'weight' => '9',
    'children' => array(
      0 => 'field_video',
      1 => 'field_theater',
      2 => 'field_theater_message',
      3 => 'field_theater_downloads',
      4 => 'field_theater_additional_video',
      5 => 'field_theater_download_box_copy',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-theater field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_theater|node|myngl|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_uploads|field_collection_item|field_myngl_invitees|form';
  $field_group->group_name = 'group_uploads';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_myngl_invitees';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'File Uploads',
    'weight' => '4',
    'children' => array(
      0 => 'field_image_upload',
      1 => 'field_document_upload',
      2 => 'field_video_upload',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-uploads field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_uploads|field_collection_item|field_myngl_invitees|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_user_account|field_collection_item|field_myngl_invitees|form';
  $field_group->group_name = 'group_user_account';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_myngl_invitees';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'User Account Info',
    'weight' => '2',
    'children' => array(
      0 => 'field_invitee_user_account',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-user-account field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_user_account|field_collection_item|field_myngl_invitees|form'] = $field_group;

  return $export;
}
