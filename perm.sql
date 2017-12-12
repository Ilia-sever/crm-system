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
13 - setup_types
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
	
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '1', '6');
	/*Delete*/
	
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '1', '5');
	/*Create*/

	/*Update*/
	
	/*Delete*/
	
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
	
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '3', '6');
	/*Delete*/
	
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '1');
	/*Create*/
	
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '3', '6');
	/*Delete*/
	
	/*Set fields*/


/* 4.Clients*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '4', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '4', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '4', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '4', '4');
	/*Set fields*/


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '4', '1');
	/*Create*/
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '4', '6');
	/*Delete*/
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	/*Create*/
	/*Update*/
	/*Delete*/
	/*Set fields*/


/* 5.Contacts*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '5', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '5', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '5', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '5', '4');
	/*Set fields*/


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '5', '1');
	/*Create*/
	
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '5', '6');
	/*Delete*/
	
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	
	/*Create*/
	
	/*Update*/
	
	/*Delete*/
	
	/*Set fields*/




/* 6.Workareas*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '6', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '6', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '6', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '6', '4');
	/*Set fields*/


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '6', '1');
	/*Create*/
	/*Update*/
	/*Delete*/
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '6', '1');
	/*Create*/
	/*Update*/
	/*Delete*/
	/*Set fields*/


/* 7.Transactions*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '7', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '7', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '7', '3');
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '7', '13');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '7', '4');
	/*Set fields*/


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '7', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '7', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '7', '9');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '7', '10');
	/*Set fields*/


	/*Executors*/
	
	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '7', '5');
	/*Create*/
	/*Update*/
	/*Delete*/
	/*Set fields*/


/* 8.Documents*/

	/*Directors*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '8', '1');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '8', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '8', '3');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '1', '8', '4');
	/*Set fields*/


	/*Managers*/

	/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '8', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '8', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '8', '9');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '2', '8', '10');
	/*Set fields*/


	/*Executors*/
	
		/*Watch*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '8', '5');
	/*Create*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '8', '2');
	/*Update*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '8', '9');
	/*Delete*/
	INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES (NULL, '3', '8', '10');
	/*Set fields*/
