create DATABASE facebook1;
CREATE TABLE users(
		UserID int(11) AUTO_INCREMENT,
		Fname varchar(25) not NULL,
		Lname varchar(25) not NULL,
		Nickname varchar(25) ,
		Password varchar(256) not NULL,
		Phone1 varchar(25) ,
		Phone2 varchar(25) ,
		Email varchar(25) unique not null,
		Gender boolean not null,
		Birthdate date not null,
		ProfilePic Varchar(30) not null,
		Hometown varchar(25),
		RelationshipStatus varchar(25),
		Bio varchar(1000),
		PRIMARY key(UserID)
	);
	Create Table post(
		Pid int(11) AUTO_INCREMENT,
		Caption varchar(256) not null,
		Image varchar(25) ,
		PostTime TIMESTAMP not null,
		AuthorID int(20),
		Foreign key(AuthorID) REFERENCES Users(UserID), 
		PRIMARY key(Pid)
	);

	Create Table add_user(
		SenderID int(20) not null,
		ReceiverID int(20) not null,
		RequestTime TIMESTAMP not null,
		Foreign key(SenderID) REFERENCES Users(UserID),
		Foreign key(ReceiverID) REFERENCES Users(UserID)
	);

	Create Table friends(
		UserID int(20) not null,
		FriendID int(20) not null,
		Foreign key(userID) REFERENCES Users(UserID),
		Foreign key(FriendID) REFERENCES Users(UserID)
	);