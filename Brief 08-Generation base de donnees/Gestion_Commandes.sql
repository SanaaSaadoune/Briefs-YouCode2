/*==============================================================*/
/* Nom de SGBD :  Microsoft SQL Server 2008                     */
/* Date de cr�ation :  26/04/2020 15:31:01                      */
/*==============================================================*/
create database Gestion_Commandes
use Gestion_Commandes

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Client') and o.name = 'FK_CLIENT_COMMANDER_COMMANDE')
alter table Client
   drop constraint FK_CLIENT_COMMANDER_COMMANDE
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Contenir') and o.name = 'FK_CONTENIR_CONTENIR_ARTICLE')
alter table Contenir
   drop constraint FK_CONTENIR_CONTENIR_ARTICLE
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Contenir') and o.name = 'FK_CONTENIR_CONTENIR_COMMANDE')
alter table Contenir
   drop constraint FK_CONTENIR_CONTENIR_COMMANDE
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Article')
            and   type = 'U')
   drop table Article
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Client')
            and   name  = 'COMMANDER_FK'
            and   indid > 0
            and   indid < 255)
   drop index Client.COMMANDER_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Client')
            and   type = 'U')
   drop table Client
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Commande')
            and   type = 'U')
   drop table Commande
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Contenir')
            and   name  = 'CONTENIR_FK'
            and   indid > 0
            and   indid < 255)
   drop index Contenir.CONTENIR_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Contenir')
            and   type = 'U')
   drop table Contenir
go

/*==============================================================*/
/* Table : Article                                              */
/*==============================================================*/
create table Article (
   Num_Artc             int                  not null,
   Nom_Artc             varchar(254)         null,
   Prix                 float                null,
   constraint PK_ARTICLE primary key (Num_Artc)
)
go


/*==============================================================*/
/* Table : Client                                               */
/*==============================================================*/
create table Client (
   CIN                  varchar(254)         not null,
   Num_Cmd              int                  null,
   Nom                  varchar(254)         null,
   Prenom               varchar(254)         null,
   Adresse              varchar(254)         null,
   constraint PK_CLIENT primary key (CIN)
)
go

/*==============================================================*/
/* Index : COMMANDER_FK                                         */
/*==============================================================*/
create index COMMANDER_FK on Client (
Num_Cmd ASC
)
go

/*==============================================================*/
/* Table : Commande                                             */
/*==============================================================*/
create table Commande (
   Num_Cmd              int                  not null,
   Date_Cmd             datetime             null,
   constraint PK_COMMANDE primary key (Num_Cmd)
)
go


/*==============================================================*/
/* Table : Contenir                                             */
/*==============================================================*/
create table Contenir (
   Num_Cmd              int                  null,
   Num_Artc             int                  null,
   Quantite             int                  null
)
go

/*==============================================================*/
/* Index : CONTENIR_FK                                          */
/*==============================================================*/
create index CONTENIR_FK on Contenir (
Num_Cmd ASC
)
go

alter table Client
   add constraint FK_CLIENT_COMMANDER_COMMANDE foreign key (Num_Cmd)
      references Commande (Num_Cmd)
go

alter table Contenir
   add constraint FK_CONTENIR_CONTENIR_ARTICLE foreign key (Num_Artc)
      references Article (Num_Artc)
go

alter table Contenir
   add constraint FK_CONTENIR_CONTENIR_COMMANDE foreign key (Num_Cmd)
      references Commande (Num_Cmd)
go








/* Traitement d'insertion dans les tables */

INSERT INTO Article VALUES (1,'Brosse',100)
INSERT INTO Article VALUES (2,'Sac',200)
INSERT INTO Article VALUES (3,'Casquette',150)

INSERT INTO Client VALUES ('H12345',1,'Saadoune','Sanaa','01, Quartier 1,Safi')
INSERT INTO Client VALUES ('H6789',1,'Abcd','Salma','04, Quartier 2,Safi')

INSERT INTO Commande VALUES (1,'06/03/2020')
INSERT INTO Commande VALUES (2,'02/02/2020')

Select * from Article
Select * from Client
Select * from Commande


/* Traitement de modification */

Update Article set Nom_Artc='Cartable' where Num_Artc=1

Update Client set Adresse='01, Quartier 5,Safi' where CIN='H12345'


/* Traitement de suppression */

Delete from Article where Num_Artc=3

Delete from Client where CIN='H6789'






