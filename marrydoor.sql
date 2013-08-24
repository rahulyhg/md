
USE `dileepgm_marrydoor`;

-- ---------- Table for users --------------- 

create table users(userId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, marryId VARCHAR(100) UNIQUE, 
emailId VARCHAR(100) NOT NULL UNIQUE,  password VARCHAR(100) NOT NULL, name VARCHAR(250) NOT NULL, 
dob DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00', gender char(1) NOT NULL DEFAULT 'M', motherTounge int(10) NOT NULL, createdOn DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
active TINYINT(5) NOT NULL, handicapped TINYINT(5) NOT NULL, highlighted TINYINT(5) NOT NULL, userType TINYINT NOT NULL, PRIMARY KEY(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --------Table for userLoggedDetails-------------

create table userloggeddetails(logId BIGINT
UNIQUE NOT NULL AUTO_INCREMENT,userId BIGINT NOT NULL, loggedIn DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00', 
loggedOut DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00', 
profileUpdage TINYINT(1) DEFAULT 0, PRIMARY KEY(logId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;

-- ------Table for userPersonalDetails------------


create table userpersonaldetails(personalDetailsId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, 
casteId BIGINT NOT NULL DEFAULT 0, religionId BIGINT NOT NULL DEFAULT 0, 
countryId BIGINT NOT NULL DEFAULT 0, stateId BIGINT NOT NULL DEFAULT 0,
 districtId BIGINT NOT NULL DEFAULT 0, placeId BIGINT NOT NULL DEFAULT 0, 
 mobilePhone BIGINT(15) NOT NULL, landPhone BIGINT(15) NOT NULL, 
 intercasteable TINYINT NOT NULL DEFAULT 0, createdBy TINYINT NOT NULL DEFAULT 0, 
 maritalStatus TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(personalDetailsId), 
 FOREIGN KEY(userId) REFERENCES users(userId),
 FOREIGN KEY(casteId) REFERENCES caste(casteId),
 FOREIGN KEY(religionId) REFERENCES religion(religionId),
 FOREIGN KEY(countryId) REFERENCES country(countryId),
 FOREIGN KEY(stateId) REFERENCES states(stateId),
 FOREIGN KEY(districtId) REFERENCES districts(districtId)
 )ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --------Table for userContactDetails--------------

create table usercontactdetails(contactDetailsId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, mobileNo INT(10) NOT NULL, landLine INT(15) NOT NULL, alternativeNo VARCHAR(20) NOT NULL, facebookUrl VARCHAR(255), skypeId VARCHAR(255), googleIM VARCHAR(255), yahooIM VARCHAR(255), visibility TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(contactDetailsId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- ------Table for address---------

create table address(addressId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, houseName VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postoffice VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, pincode INT(10) NOT NULL, addresType TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(addressId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



-- ---Table for physicalDetails------

create table physicaldetails(physicalId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, heightId BIGINT NOT NULL, weight INT NOT NULL, bodyType TINYINT NOT NULL DEFAULT 0, complexion TINYINT NOT NULL DEFAULT 0, physicalStatus TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(physicalId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- ---- Tale for education----------

create table education(edId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, 
educationId BIGINT NOT NULL, occupationId BIGINT NOT NULL, employedIn TINYINT NOT NULL DEFAULT 0,
yearlyIncome INT(11) NOT NULL, PRIMARY KEY(edId),
FOREIGN KEY (userId) REFERENCES users(userId),
FOREIGN KEY(educationId) REFERENCES education_master(educationId),
FOREIGN KEY(occupationId) REFERENCES occupation_master(occupationId)
)ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- ---- Table for habit------

create table habit(habitId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, food TINYINT NOT NULL DEFAULT 0, smoking TINYINT NOT NULL DEFAULT 0, drinking TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(habitId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- ---Table for familyProfile-----

create table familyprofile(familyProfileID BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, familyStatus TINYINT NOT NULL DEFAULT 0, familyType TINYINT NOT NULL DEFAULT 0, familyValues TINYINT NOT NULL DEFAULT 0, brothers INT NOT NULL, sisters INT NOT NULL, brotherMarried INT NOT NULL, SisterMarried INT NOT NULL, familyPic VARCHAR(255), visibility TINYINT NOT NULL DEFAULT 0, familyDesc TEXT NOT NULL, userDesc TEXT NOT NULL, PRIMARY KEY(familyProfileID), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- --Table for hobiesAndInterests-----

create table hobiesandinterests(hobiesId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, hobies TEXT NOT NULL, interests TEXT NOT NULL, musics TEXT NOT NULL, reading TEXT NOT NULL, movies TEXT NOT NULL, activities TEXT NOT NULL, cuisine TEXT NOT NULL, languages TEXT NOT NULL, languageOther VARCHAR(100) NOT NULL, PRIMARY KEY(hobiesId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- -------Table for partnerPreferences--------

create table partnerpreferences(preferenceId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, 
userId BIGINT NOT NULL,ageFrom INT(10) NOT NULL DEFAULT 0, ageTo INT(10) NOT NULL DEFAULT 0,
 maritalStatus TINYINT, haveChildren TINYINT , heightFrom INT(10),
heightTo INT(10), physicalStatus TINYINT, religion INT(10) ,caste INT(10) ,
subcaste TEXT , manglik TINYINT ,dosham INT(100) , sudham INT(100) ,star TEXT , 
eatingHabits TEXT , drinkingHabits TEXT , smokingHabits TEXT , languages TEXT , countries TEXT , 
states TEXT , districts TEXT , places TEXT , citizenship TEXT , occupation TEXT , 
annualIncome INT , partnerDescription TEXT , PRIMARY KEY(preferenceId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- ----Table for photos-----

create table photos(photoId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, imageName VARCHAR(100) NOT NULL, profileImage TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(photoId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --TABLE FOR documents

create table documents(documentId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, documentName VARCHAR(100) NOT NULL, documentType TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(documentId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;	


-- ---TABLE FOR horoscopes-----

create table horoscopes(horoscopeId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, motherTounge int(10) NOT NULL, sign INT(11) NOT NULL,time VARCHAR(250), astrodate INT(11),dob VARCHAR(250),country VARCHAR(250), state VARCHAR(250),city VARCHAR(250) , horoscopeFile VARCHAR(100), grahanilaFile VARCHAR(100), visibility INT(100) DEFAULT NULL, dosham INT(100) DEFAULT NULL, sudham INT(100) DEFAULT NULL, PRIMARY KEY(horoscopeId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- --TABLE FOR reference----

create table reference(referenceId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, relation VARCHAR(250) NOT NULL, referName VARCHAR(250) NOT NULL, referHouseName VARCHAR(250) NOT NULL, referPlace VARCHAR(250) NOT NULL, referCity VARCHAR(250) NOT NULL, referState VARCHAR(250) NOT NULL, referPostcode INT(15) NOT NULL, referPostOffice VARCHAR(250) NOT NULL, referDistrict VARCHAR(250) NOT NULL, referCountry VARCHAR(250) NOT NULL, referEmail VARCHAR(250) NOT NULL, referOccupation vARCHAR(250) NOT NULL, referCallFrom VARCHAR(50) NOT NULL, referCallTo INT(10) NOT NULL, referCallTime CHAR(2) NOT NULL, visibility TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(referenceId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --TABLE FOR messages

create table messages(messageId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, message TEXT NOT NULL,
 status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, senderStatus TINYINT NOT NULL DEFAULT 0,receiverStatus TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(messageId),FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
 


-- ---table for interests------

 create table interests (interestId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, status TINYINT NOT NULL DEFAULT 0, sendDate DATETIME NOT NULL,statusChange DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00', senderStatus TINYINT NOT NULL DEFAULT 0,receiverStatus TINYINT NOT NULL DEFAULT 0, PRIMARY KEY(interestId),FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



-- --table for shortlist----

create table shortlist(shortlistId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userID BIGINT NOT NULL, profileID text NOT NULL, PRIMARY KEY(shortlistId),FOREIGN KEY (userID) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --table for profileViews---
create table profileviews(profileViewId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userID BIGINT NOT NULL, visitedId BIGINT NOT NULL,counter INT NOT NULL DEFAULT 0,visitTime DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' , PRIMARY KEY(profileViewId),FOREIGN KEY (userID) REFERENCES users(userId),FOREIGN KEY (visitedId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- -table for admin_users---

create table admin_users(adminId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, username VARCHAR(250) NOT NULL, password VARCHAR(250) NOT NULL, email VARCHAR(250) NOT NULL,adminTypeId BIGINT NOT NULL, lastLogin DATETIME NOT NULL, status BIGINT NOT NULL DEFAULT 1, PRIMARY KEY(adminId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- -table for admin_types---

create table admin_types(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, type VARCHAR(10) NOT NULL, PRIMARY KEY(id))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- -tables for coupon---

create table coupon(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, couponCode VARCHAR(15) UNIQUE NOT NULL, creationDate DATETIME NOT NULL, startDate DATE NOT NULL, endDate DATE NOT NULL, validity INT(2), status TINYINT NOT NULL DEFAULT 0, isUsed TINYINT NOT NULL DEFAULT 0, batchNo VARCHAR(10) NOT NULL, serialNo INT (8) NOT NULL, couponId INT(10) NOT NULL, couponType ENUM( 'normal', 'promo' ) NOT NULL DEFAULT 'normal', PRIMARY KEY(id))ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;	

-- -table for coupon_logs---

create table coupon_logs(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, adminUserId INT(10) NOT NULL, batchNo INT(10) UNIQUE NOT NULL, creationTime DATETIME NOT NULL, PRIMARY KEY(id))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



-- table for privacy
create table privacy (id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL,items ENUM('album', 'family', 'documents','astro','reference','contact'),privacy SET('all', 'subscribers', 'member', 'request'), PRIMARY KEY(id),FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- TABLE FOR album

create table album(albumId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, PRIMARY KEY(albumId), FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- Table for documentRequest

create table documentrequest(documentRequestId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, PRIMARY KEY(documentRequestId), FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- Table for contactRequest

create table contactrequest(contactRequestId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, PRIMARY KEY(contactRequestId), FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- Table for familyAlbum

create table familyalbum(familyAlbumId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, PRIMARY KEY(familyAlbumId), FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- alter the photos table

ALTER TABLE photos ADD active TINYINT(4) DEFAULT 0 AFTER profileImage;

-- alter the documents table

ALTER TABLE documents ADD active TINYINT(4) DEFAULT 0 AFTER documentType;


create table search(searchId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, searchText text NOT NULL, searchQquery text NOT NULL, userId BIGINT NOT NULL, PRIMARY KEY(searchId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- --table for bookmark----

create table bookmark(bookMarkId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userID BIGINT NOT NULL, profileIDs text NOT NULL, PRIMARY KEY(bookMarkId),FOREIGN KEY (userID) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- table for payment --
create table payment(paymentId BIGINT NOT NULL AUTO_INCREMENT, userID bigint not null, couponcode varchar(15) NOT NULL, startdate datetime NOT NULL,createdate datetime NOT NULL, actionItem enum('highlight','membership'), PRIMARY KEY(paymentId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

alter table payment add unique index(userID,couponcode);

-- --table for addressbook ---
create table addressbook(addressbookId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userID BIGINT NOT NULL, visitedId text NOT NULL, PRIMARY KEY(addressbookId),FOREIGN KEY (userID) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


RENAME TABLE album TO albumrequest;

-- table album --

CREATE TABLE IF NOT EXISTS album (
  albumId bigint(20) NOT NULL AUTO_INCREMENT,
  userId bigint(20) NOT NULL,
  imageName varchar(100) NOT NULL,
  description varchar(200) NULL,
  active tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (albumId),
  FOREIGN KEY (userId) REFERENCES users(userId),
  UNIQUE KEY albumId (albumId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- table for profile udpate logging --
CREATE TABLE IF NOT EXISTS `profileupdates` (
  `profileId` bigint(20) NOT NULL auto_increment,
  `userId` bigint(20) NOT NULL,
  `profile` enum('personal','education','partner','hobby','profile','album','documents') default NULL,
  `status` text NOT NULL,
  `statusTime` datetime NOT NULL,
  PRIMARY KEY  (`profileId`),
  UNIQUE KEY `profileId` (`profileId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;


-- table for profile blocking --
create table profileblock(profileBlockId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, 
userId BIGINT NOT NULL, profileIDs text NOT NULL, PRIMARY KEY(profileBlockId)
,FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP VIEW IF EXISTS view_users;

CREATE VIEW view_users AS SELECT U.*, FLOOR( DATEDIFF( CURRENT_DATE, U.dob) /365 ) as age,UC.mobileNo,UC.landLine,UC.alternativeNo,UC.facebookUrl,UC.skypeId,UC.googleIM,UC.yahooIM,UC.visibility,
UP.casteId as casteId,C.name as caste,UP.religionId as religionId, R.name as religion,UP.countryId,CO.name as country,UP.stateId,S.name as state,UP.districtId,D.name as district,UP.placeId as placeId, PL.name as place,UP.mobilePhone,UP.landPhone,UP.intercasteable,UP.createdBy,UP.maritalStatus,
P.heightId,P.weight,P.bodyType,P.complexion,P.physicalstatus,PB.profileIDs as profileBlocked,FP.userDesc as userDesc,
H.dosham as dosham,H.sudham as sudham,H.horoscopeFile as horoscope,H.astrodate as star,HA.food,HA.smoking,HA.drinking,HI.languages,PH.imageName as photo,
EL.educationId as educationId,EM.name as educationName,EL.occupationId as occupationId,OM.name as occupationName,EL.yearlyIncome as annualIncome
FROM users U
LEFT JOIN usercontactdetails UC ON U.userId = UC.userId
LEFT JOIN userpersonaldetails UP ON U.userId = UP.userId
LEFT JOIN physicaldetails P ON U.userId = P.userId
LEFT JOIN familyprofile FP ON U.userId = FP.userId
LEFT JOIN caste C ON UP.casteId = C.casteId
LEFT JOIN religion R ON UP.religionId = R.religionId
LEFT JOIN country CO ON UP.countryId = CO.countryId
LEFT JOIN states S ON UP.stateId = S.stateId
LEFT JOIN districts D ON UP.districtId = D.districtId
LEFT JOIN places PL ON UP.placeId = PL.placeId
LEFT JOIN education EL ON U.userId = EL.userId
LEFT JOIN profileblock PB ON U.userId = PB.userId
LEFT JOIN horoscopes H ON U.userId = H.userId
LEFT JOIN photos PH ON U.userId = PH.userId
LEFT JOIN hobiesandinterests HI on U.userId = HI.userId 
LEFT JOIN habit HA ON U.userId = HA.userId
LEFT JOIN education_master EM ON EL.educationId = EM.educationId
LEFT JOIN occupation_master OM ON EL.occupationId  = OM.occupationId;

-- view to get the messages

DROP VIEW IF EXISTS view_messages;

CREATE VIEW view_messages AS SELECT M.*, SU.userId as senderUserId, SU.marryId as senderMarryId,SU.emailId as senderEmailId, SU.name as senderName, FLOOR( DATEDIFF( CURRENT_DATE, SU.dob) /365 ) as senderAge,
SU.gender senderGender, SU.motherTounge as senderMotherTounge, SU.userType as senderUserType, RU.userId as receiverUserId, RU.marryId as receiverMarryId,RU.emailId as receiverEmailId, RU.name as receiverName, FLOOR( DATEDIFF( CURRENT_DATE, RU.dob) /365 ) as receiverAge,
RU.gender receiverGender, RU.motherTounge as receiverMotherTounge, RU.userType as receiverUserType,SP.photoId as senderPhotoId, SP.imageName as senderImageName, RP.photoId as receiverPhotoId, RP.imageName as receiverImageName
FROM messages M
JOIN users SU ON M.senderId = SU.userId
JOIN users RU ON M.receiverId = RU.userId
LEFT JOIN photos SP ON (M.senderId = SP.userId AND SP.profileImage = 1)
LEFT JOIN photos RP ON (M.receiverId = RP.userId AND RP.profileImage = 1);



ALTER TABLE users ADD UNIQUE (emailId);
ALTER TABLE `userpersonaldetails` CHANGE `landPhone` `landPhone` BIGINT( 15 ) NOT NULL; 
ALTER TABLE `userpersonaldetails` CHANGE `mobilePhone` `mobilePhone` BIGINT( 15 ) NULL DEFAULT NULL; 
ALTER TABLE `partnerpreferences` CHANGE `caste` `caste` TEXT NULL DEFAULT NULL; 
ALTER TABLE  `album` ADD  `type` INT( 1 ) NOT NULL DEFAULT  '0' COMMENT  '0-profile, 1- family' AFTER  `description`;
ALTER TABLE  `album` ADD  `photorelation` INT( 1 ) NOT NULL DEFAULT  '0' COMMENT  '1-father, 2- mother,3-brother, 4- sister' AFTER  `type`;


create table savesearch(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT,userId BIGINT NOT NULL,searchName varchar(100) NOT NULL, 
gender char(1),ageFrom INT(10),ageTo INT(10),
maritalStatus TEXT, heightFrom INT(10),
heightTo INT(10), physicalStatus TINYINT, religion INT(10), state INT(10) ,district INT(10) ,occupation TEXT , residentStatus INT(10),
motherTounge TEXT,countries TEXT ,caste TEXT,keyword TEXT,education TEXT , annualIncomeFrom INT,annualIncomeTo INT,star TEXT,dosham INT(10) , sudham INT(10), eating TEXT,
drinking TEXT, smoking TEXT,photo TINYINT,horoscope TINYINT,showTo TEXT,
PRIMARY KEY(id), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- view to get the visitor details

DROP VIEW IF EXISTS view_profile;

CREATE VIEW view_profile AS SELECT PV.*,U.name,U.marryId,U.dob,FLOOR( DATEDIFF( CURRENT_DATE, U.dob) /365 ) as age,U.gender,UP.casteId as casteId,C.name as caste,UP.religionId as religionId, R.name as religion,UP.countryId,CO.name as country,UP.stateId,S.name as state,UP.districtId,D.name as district,UP.placeId as placeId, PL.name as place,P.imageName as imageName
FROM profileviews PV
JOIN users U ON PV.userID = U.userId
LEFT JOIN userpersonaldetails UP ON PV.userID = UP.userId
LEFT JOIN caste C ON UP.casteId = C.casteId
LEFT JOIN religion R ON UP.religionId = R.religionId
LEFT JOIN country CO ON UP.countryId = CO.countryId
LEFT JOIN states S ON UP.stateId = S.stateId
LEFT JOIN districts D ON UP.districtId = D.districtId
LEFT JOIN places PL ON UP.placeId = PL.placeId
LEFT JOIN photos P ON (U.userId = P.userId AND P.profileImage = 1);



create table feedback(feedId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, name VARCHAR(250),email VARCHAR(250),message text, feedType  VARCHAR(250),friendliness tinyint(5),service  tinyint(5),
privacy  	tinyint(5),payment  	tinyint(5),reseller  	tinyint(5), PRIMARY KEY(feedId))ENGINE=MYISAM DEFAULT CHARSET=utf8;

create table delete_feedback(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, married tinyint(5),service tinyint(5),engaged  tinyint(5),other tinyint(5),useful tinyint(5),compromised  	tinyint(5), PRIMARY KEY(id),FOREIGN KEY(userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



-- view to get the messages

DROP VIEW IF EXISTS view_interests;

CREATE VIEW view_interests AS SELECT I.*, SU.userId as senderUserId, SU.marryId as senderMarryId,SU.emailId as senderEmailId, SU.name as senderName, FLOOR( DATEDIFF( CURRENT_DATE, SU.dob) /365 ) as senderAge,
SU.gender senderGender, SU.motherTounge as senderMotherTounge, SU.userType as senderUserType,
UP.casteId as senderCasteId,C.name as senderCaste,UP.religionId as senderReligionId, R.name as senderReligion,UP.countryId,CO.name as senderCountry,UP.stateId,S.name as senderState,UP.districtId,D.name as senderDistrict,UP.placeId as senderPlaceId, PL.name as senderPlace,
P.heightId as senderHeightId,P.weight as senderWeight,P.bodyType as senderBodyType,P.complexion as senderComplexion,P.physicalstatus as senderPhysicalStatus,

RU.userId as receiverUserId, RU.marryId as receiverMarryId,RU.emailId as receiverEmailId, RU.name as receiverName, FLOOR( DATEDIFF( CURRENT_DATE, RU.dob) /365 ) as receiverAge,
RU.gender receiverGender, RU.motherTounge as receiverMotherTounge, RU.userType as receiverUserType,
UP1.casteId as receiverCasteId,C1.name as receiverCaste,UP1.religionId as receiverReligionId, R1.name as receiverReligion,UP1.countryId as receiverCountryId,CO1.name as receiverCountry,UP1.stateId as receiverStateId,S1.name as receiverState,UP1.districtId as receiverDistictId,D1.name as receiverDistrict,UP1.placeId as receiverPlaceId, PL1.name as receiverPlace,
P1.heightId as receiverHeightId,P1.weight as receiverWeight,P1.bodyType as receiverBodyType,P1.complexion as receiverComplexion,P1.physicalstatus as receiverPhysicalStatus,
SP.photoId as senderPhotoId, SP.imageName as senderImageName, RP.photoId as receiverPhotoId, RP.imageName as receiverImageName
FROM interests I
JOIN users SU ON I.senderId = SU.userId
LEFT JOIN userpersonaldetails UP ON I.senderId = UP.userId
LEFT JOIN physicaldetails P ON I.senderId = P.userId
LEFT JOIN caste C ON UP.casteId = C.casteId
LEFT JOIN religion R ON UP.religionId = R.religionId
LEFT JOIN country CO ON UP.countryId = CO.countryId
LEFT JOIN states S ON UP.stateId = S.stateId
LEFT JOIN districts D ON UP.districtId = D.districtId
LEFT JOIN places PL ON UP.placeId = PL.placeId

JOIN users RU ON I.receiverId = RU.userId

LEFT JOIN userpersonaldetails UP1 ON I.receiverId = UP1.userId
LEFT JOIN physicaldetails P1 ON I.receiverId = P1.userId
LEFT JOIN caste C1 ON UP1.casteId = C1.casteId
LEFT JOIN religion R1 ON UP1.religionId = R1.religionId
LEFT JOIN country CO1 ON UP1.countryId = CO1.countryId
LEFT JOIN states S1 ON UP1.stateId = S1.stateId
LEFT JOIN districts D1 ON UP1.districtId = D1.districtId
LEFT JOIN places PL1 ON UP1.placeId = PL1.placeId

LEFT JOIN photos SP ON (I.senderId = SP.userId AND SP.profileImage = 1)
LEFT JOIN photos RP ON (I.receiverId = RP.userId AND RP.profileImage = 1);

-- Table for Requests

create table requests(requestId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, senderId BIGINT NOT NULL, receiverId BIGINT NOT NULL, requestType tinyint(5) COMMENT '1-documents, 2- album, 3- family album, 4-astro, 5- contact, 6 - reference', status TINYINT NOT NULL DEFAULT 0, sendDate DATE NOT NULL, PRIMARY KEY(requestId), FOREIGN KEY (senderId) REFERENCES users(userId), FOREIGN KEY (receiverId) REFERENCES users(userID))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- view to get the messages

DROP VIEW IF EXISTS view_requests;

CREATE VIEW view_requests AS SELECT RE.*, SU.userId as senderUserId, SU.marryId as senderMarryId,SU.emailId as senderEmailId, SU.name as senderName, FLOOR( DATEDIFF( CURRENT_DATE, SU.dob) /365 ) as senderAge,
SU.gender senderGender, SU.motherTounge as senderMotherTounge, SU.userType as senderUserType,
UP.casteId as senderCasteId,C.name as senderCaste,UP.religionId as senderReligionId, R.name as senderReligion,UP.countryId,CO.name as senderCountry,UP.stateId,S.name as senderState,UP.districtId,D.name as senderDistrict,UP.placeId as senderPlaceId, PL.name as senderPlace,
P.heightId as senderHeightId,P.weight as senderWeight,P.bodyType as senderBodyType,P.complexion as senderComplexion,P.physicalstatus as senderPhysicalStatus,

RU.userId as receiverUserId, RU.marryId as receiverMarryId,RU.emailId as receiverEmailId, RU.name as receiverName, FLOOR( DATEDIFF( CURRENT_DATE, RU.dob) /365 ) as receiverAge,
RU.gender receiverGender, RU.motherTounge as receiverMotherTounge, RU.userType as receiverUserType,
UP1.casteId as receiverCasteId,C1.name as receiverCaste,UP1.religionId as receiverReligionId, R1.name as receiverReligion,UP1.countryId as receiverCountryId,CO1.name as receiverCountry,UP1.stateId as receiverStateId,S1.name as receiverState,UP1.districtId as receiverDistictId,D1.name as receiverDistrict,UP1.placeId as receiverPlaceId, PL1.name as receiverPlace,
P1.heightId as receiverHeightId,P1.weight as receiverWeight,P1.bodyType as receiverBodyType,P1.complexion as receiverComplexion,P1.physicalstatus as receiverPhysicalStatus,
SP.photoId as senderPhotoId, SP.imageName as senderImageName, RP.photoId as receiverPhotoId, RP.imageName as receiverImageName
FROM requests RE
JOIN users SU ON RE.senderId = SU.userId
LEFT JOIN userpersonaldetails UP ON RE.senderId = UP.userId
LEFT JOIN physicaldetails P ON RE.senderId = P.userId
LEFT JOIN caste C ON UP.casteId = C.casteId
LEFT JOIN religion R ON UP.religionId = R.religionId
LEFT JOIN country CO ON UP.countryId = CO.countryId
LEFT JOIN states S ON UP.stateId = S.stateId
LEFT JOIN districts D ON UP.districtId = D.districtId
LEFT JOIN places PL ON UP.placeId = PL.placeId

JOIN users RU ON RE.receiverId = RU.userId

LEFT JOIN userpersonaldetails UP1 ON RE.receiverId = UP1.userId
LEFT JOIN physicaldetails P1 ON RE.receiverId = P1.userId
LEFT JOIN caste C1 ON UP1.casteId = C1.casteId
LEFT JOIN religion R1 ON UP1.religionId = R1.religionId
LEFT JOIN country CO1 ON UP1.countryId = CO1.countryId
LEFT JOIN states S1 ON UP1.stateId = S1.stateId
LEFT JOIN districts D1 ON UP1.districtId = D1.districtId
LEFT JOIN places PL1 ON UP1.placeId = PL1.placeId

LEFT JOIN photos SP ON (RE.senderId = SP.userId AND SP.profileImage = 1)
LEFT JOIN photos RP ON (RE.receiverId = RP.userId AND RP.profileImage = 1);

-- Table for Notifications
create table notifications(notificationId BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, name VARCHAR(250),marryId VARCHAR(100), notification TEXT, notificationType ENUM('album', 'family', 'documents','astro','reference','contact','password','subscribe','recharge','system'),status TINYINT NOT NULL DEFAULT 0,createdate datetime NOT NULL, PRIMARY KEY(notificationId), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- Table for inviting friends

create table invitations(id BIGINT UNIQUE NOT NULL AUTO_INCREMENT, userId BIGINT NOT NULL, email text,status TINYINT NOT NULL DEFAULT 0,createdate datetime NOT NULL, PRIMARY KEY(id), FOREIGN KEY (userId) REFERENCES users(userId))ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

ALTER TABLE  profileviews ADD  status TINYINT NOT NULL AFTER  counter;

ALTER TABLE  interests ADD  viewStatus TINYINT NOT NULL AFTER  receiverStatus;

alter table reference change referPostcode referPostcode bigint (15)  NOT NULL; 