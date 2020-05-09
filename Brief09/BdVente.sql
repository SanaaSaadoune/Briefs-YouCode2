/*==============================================================*/
/* Nom de SGBD :  Microsoft SQL Server 2008                     */
/* Date de création :  09/05/2020 14:44:24                      */
/*==============================================================*/


if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Client') and o.name = 'FK_CLIENT_ASSOCIATI_ADMIN')
alter table Client
   drop constraint FK_CLIENT_ASSOCIATI_ADMIN
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Commande') and o.name = 'FK_COMMANDE_ASSOCIATI_CLIENT')
alter table Commande
   drop constraint FK_COMMANDE_ASSOCIATI_CLIENT
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Ligne_Commande') and o.name = 'FK_LIGNE_CO_ASSOCIATI_COMMANDE')
alter table Ligne_Commande
   drop constraint FK_LIGNE_CO_ASSOCIATI_COMMANDE
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Ligne_Commande') and o.name = 'FK_LIGNE_CO_ASSOCIATI_PRODUIT')
alter table Ligne_Commande
   drop constraint FK_LIGNE_CO_ASSOCIATI_PRODUIT
go

if exists (select 1
   from sys.sysreferences r join sys.sysobjects o on (o.id = r.constid and o.type = 'F')
   where r.fkeyid = object_id('Produit') and o.name = 'FK_PRODUIT_ASSOCIATI_ADMIN')
alter table Produit
   drop constraint FK_PRODUIT_ASSOCIATI_ADMIN
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Admin')
            and   type = 'U')
   drop table Admin
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Client')
            and   name  = 'ASSOCIATION_2_FK'
            and   indid > 0
            and   indid < 255)
   drop index Client.ASSOCIATION_2_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Client')
            and   type = 'U')
   drop table Client
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Commande')
            and   name  = 'ASSOCIATION_3_FK'
            and   indid > 0
            and   indid < 255)
   drop index Commande.ASSOCIATION_3_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Commande')
            and   type = 'U')
   drop table Commande
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Ligne_Commande')
            and   name  = 'ASSOCIATION_5_FK'
            and   indid > 0
            and   indid < 255)
   drop index Ligne_Commande.ASSOCIATION_5_FK
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Ligne_Commande')
            and   name  = 'ASSOCIATION_4_FK'
            and   indid > 0
            and   indid < 255)
   drop index Ligne_Commande.ASSOCIATION_4_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Ligne_Commande')
            and   type = 'U')
   drop table Ligne_Commande
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('Produit')
            and   name  = 'ASSOCIATION_1_FK'
            and   indid > 0
            and   indid < 255)
   drop index Produit.ASSOCIATION_1_FK
go

if exists (select 1
            from  sysobjects
           where  id = object_id('Produit')
            and   type = 'U')
   drop table Produit
go

/*==============================================================*/
/* Table : Admin                                                */
/*==============================================================*/
create table Admin (
   Id_Ad                int                  not null,
   Email_Ad             varchar(254)         null,
   Password_Ad          varchar(254)         null,
   CIN_Ad               varchar(254)         null,
   constraint PK_ADMIN primary key nonclustered (Id_Ad)
)
go

/*==============================================================*/
/* Table : Client                                               */
/*==============================================================*/
create table Client (
   CIN_Cl               varchar(254)         not null,
   Id_Ad                int                  not null,
   Nom_Cl               varchar(254)         null,
   Prenom_Cl            varchar(254)         null,
   Email_Cl             varchar(254)         null,
   Password_Cl          varchar(254)         null,
   constraint PK_CLIENT primary key nonclustered (CIN_Cl)
)
go

/*==============================================================*/
/* Index : ASSOCIATION_2_FK                                     */
/*==============================================================*/
create index ASSOCIATION_2_FK on Client (
Id_Ad ASC
)
go

/*==============================================================*/
/* Table : Commande                                             */
/*==============================================================*/
create table Commande (
   Id_Cmd               int                  not null,
   CIN_Cl               varchar(254)         not null,
   Date_Cmd             datetime             null,
   Etat_Cmd             bit                  null,
   constraint PK_COMMANDE primary key nonclustered (Id_Cmd)
)
go

/*==============================================================*/
/* Index : ASSOCIATION_3_FK                                     */
/*==============================================================*/
create index ASSOCIATION_3_FK on Commande (
CIN_Cl ASC
)
go

/*==============================================================*/
/* Table : Ligne_Commande                                       */
/*==============================================================*/
create table Ligne_Commande (
   Id_Cmd               int                  not null,
   Id_Prod              int                  not null,
   Quantite             int                  null
)
go

/*==============================================================*/
/* Index : ASSOCIATION_4_FK                                     */
/*==============================================================*/
create index ASSOCIATION_4_FK on Ligne_Commande (
Id_Cmd ASC
)
go

/*==============================================================*/
/* Index : ASSOCIATION_5_FK                                     */
/*==============================================================*/
create index ASSOCIATION_5_FK on Ligne_Commande (
Id_Prod ASC
)
go

/*==============================================================*/
/* Table : Produit                                              */
/*==============================================================*/
create table Produit (
   Id_Prod              int                  not null,
   Id_Ad                int                  not null,
   Nom_Prod             varchar(254)         null,
   Prix_Prod            float                null,
   Quantite_Prod        int                  null,
   Categorie            varchar(254)         null,
   constraint PK_PRODUIT primary key nonclustered (Id_Prod)
)
go

/*==============================================================*/
/* Index : ASSOCIATION_1_FK                                     */
/*==============================================================*/
create index ASSOCIATION_1_FK on Produit (
Id_Ad ASC
)
go

alter table Client
   add constraint FK_CLIENT_ASSOCIATI_ADMIN foreign key (Id_Ad)
      references Admin (Id_Ad)
go

alter table Commande
   add constraint FK_COMMANDE_ASSOCIATI_CLIENT foreign key (CIN_Cl)
      references Client (CIN_Cl)
go

alter table Ligne_Commande
   add constraint FK_LIGNE_CO_ASSOCIATI_COMMANDE foreign key (Id_Cmd)
      references Commande (Id_Cmd)
go

alter table Ligne_Commande
   add constraint FK_LIGNE_CO_ASSOCIATI_PRODUIT foreign key (Id_Prod)
      references Produit (Id_Prod)
go

alter table Produit
   add constraint FK_PRODUIT_ASSOCIATI_ADMIN foreign key (Id_Ad)
      references Admin (Id_Ad)
go

