TRUNCATE permissions;

/* 
Available actions:

1 - watch all
2 - create
3 - update all
4 - delete all
5 - watch related
6 - update related
7 - delete related
8 - watch controlled
9 - update controlled
10 - delete controlled

11 - set_role_id
12 - set_post
*/



/* 1.Projects*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '1', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '1', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '1', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '1', '4');
	/*Set fields*/

	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '1', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '1', '0');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '1', '6');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '1', '0');
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '1', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '1', '0');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '1', '0');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '1', '0');
	/*Set fields*/

/* 2.Tasks*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '2', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '2', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '2', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '2', '4');
	/*Set fields*/

	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '2', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '2', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '2', '9');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '2', '10');
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '2', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '2', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '2', '9');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '2', '10');
	/*Set fields*/


/* 3.Employees*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '4');
	/*Set fields*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '11');
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '3', '12');


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '3', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '3', '0');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '3', '6');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '3', '0');
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '0');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '6');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '0');
	/*Set fields*/

