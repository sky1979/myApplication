use uplink_test;



 
INSERT INTO user (firstname, lastname, password)
VALUES ('John', 'Doe', 'Encrypt');
INSERT INTO user (firstname, lastname, password)
VALUES ('Luke', 'Smith', 'Encrypt');
INSERT INTO user (firstname, lastname, password)
VALUES ('Sam', 'Sky', 'Encrypt');
INSERT INTO user (firstname, lastname, password)
VALUES ('Jorge', 'Toe', 'Encrypt');
 
INSERT INTO user_right (user_id, unlocked, right1, right2)
VALUES (1, false, false, false);  /* id=1 */
INSERT INTO user_right (user_id, unlocked, right1, right2)
VALUES (2, false, true, false);   /* id=2 */	
INSERT INTO user_right (user_id, unlocked, right1, right2)
VALUES (3, false, true, true);    /* id=3 */
INSERT INTO user_right (user_id, unlocked, right1, right2)
VALUES (4, true, true, true);     /* id=4 */
 
 