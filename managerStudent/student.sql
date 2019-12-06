create database user21;
use user21;

create table U_ser(
	id int not null auto_increment primary key,
    firstName varchar(50),
    lastName varchar(50),
    mathScore decimal(5,3),
    javaScore decimal(5,3)
);

insert into U_ser values(null,'anh','nguyen',8.9,9.9);
insert into U_ser values(null,'a','nguyen',8,9);
 select *from U_ser;
 
create table A_dmin(
	useName varchar(50),
    pass varchar(50)
);

insert into A_dmin values('anh','123');
insert into A_dmin values('a','123');
