drop table if exists COMPTE;
drop table if exists AIME;
drop table if exists RT;
drop table if exists POST;
drop table if exists PHOTO;
drop table if exists COMMENTAIRE;
drop table if exists CITATION;
drop table if exists FOLLOW;

create table COMPTE(
    IDCOMPTE              SERIAL          NOT NULL,
    LOGINCOMPTE           VARCHAR(20)     NOT NULL,
    PSEUDOCOMPTE          VARCHAR(20)     NOT NULL,
    MDPCOMPTE             VARCHAR(100)     NOT NULL,
    DESCRIPTIONCOMPTE     VARCHAR(200)    NOT NULL,
    IDBANIERECOMPTE       INT4            NOT NULL,
    IDPPCOMPTE            INT4            NOT NULL,
    constraint PK_COMPTE primary key (IDCOMPTE),
    constraint AK_CLEUNIQUE_LOGINCOMPTE unique (LOGINCOMPTE)
);
create table AIME(
    IDAIME      SERIAL      NOT NULL,
    IDAIMECOMPTE    INT4        NOT NULL,
    IDAIMEPOST      INT4        NOT NULL,
    constraint PK_AIME primary key (IDAIME)
);
create table RT(
    IDRT        SERIAL       NOT NULL,
    DATERT      CHAR(10)    NOT NULL,
    IDRTCOMPTE    INT4         NOT NULL,
    IDRTPOST      INT4         NOT NULL,
    constraint PK_RT primary key (IDRT)
);
create table POST(
    IDPOST      SERIAL          NOT NULL,
    TEXTPOST    VARCHAR(280)    NOT NULL,
    DATEPOST    CHAR(10)            NOT NULL,
    IDCOMPTE    INT4            NOT NULL,
    constraint PK_POST primary key (IDPOST)
);
create table PHOTO(
    IDPHOTO     SERIAL          NOT NULL,
    URLPHOTO    VARCHAR(300)    NOT NULL,
    constraint PK_PHOTO primary key (IDPHOTO)
);
create table A_POUR_PHOTO(
    IDAPOURPHOTO      SERIAL      NOT NULL,
    IDPOST      INT4        NOT NULL,
    IDPHOTO     INT4        NOT NULL,
    constraint PK_A_POUR_PHOTO primary key (IDAPOURPHOTO)
);
create table COMMENTAIRE(
    IDCOMMENTAIRE   SERIAL      NOT NULL,
    IDPOSTCOMMENTAIRE   INT4    NOT NULL,
    IDPOSTORIGINALCOMMENTAIRE INT4 NOT NULL,
    constraint PK_COMMENTAIRE primary key(IDCOMMENTAIRE)
);
create table CITATION(
    IDCITATION          SERIAL      NOT NULL,
    IDPOSTCITATION      INT4        NOT NULL,
    IDPOSTCITATIONORIGINAL      INT4    NOT NULL,
    constraint PK_CITATION primary key (IDCITATION)
);
create table FOLLOW(
    IDFOLLOW    SERIAL      NOT NULL,
    IDCOMPTEFOLLOW      INT4    NOT NULL,
    IDCOMPTEQUIFOLLOW   INT4    NOT NULL
);


/*Liens de la table follow*/

alter table FOLLOW
    add constraint FK_FOLLOW_COMPTE foreign key (IDCOMPTEFOLLOW)
        references COMPTE (IDCOMPTE)
        on delete restrict on update restrict;
/*Liens de la table AIME*/
alter table FOLLOW
    add constraint FK_FOLLOW_COMPTEQUISUIT foreign key (IDCOMPTEQUIFOLLOW)
        references COMPTE (IDCOMPTE)
        on delete restrict on update restrict;



/*Liens de la table compte*/
alter table COMPTE
    add constraint FK_COMPTE_PHOTO foreign key (IDPPCOMPTE)
        references PHOTO (IDPHOTO)
        on delete restrict on update restrict;
/*Liens de la table AIME*/
alter table AIME
    add constraint FK_AIME_POST foreign key (IDAIMEPOST)
        references POST (IDPOST)
        on delete restrict on update restrict;

alter table AIME
    add constraint FK_AIME_COMPTE foreign key (IDAIMECOMPTE)
        references COMPTE (IDCOMPTE)
        on delete restrict on update restrict;

/*Liens de la table rt*/
alter table RT
    add constraint FK_RT_POST foreign key (IDRTPOST)
        references POST (IDPOST)
        on delete restrict on update restrict;

alter table RT
    add constraint FK_RT_COMPTE foreign key (IDRTCOMPTE)
        references COMPTE (IDCOMPTE)
        on delete restrict on update restrict;

/*Liens de la table a_pour_photo*/
alter table A_POUR_PHOTO
    add constraint FK_APHOTO_POST foreign key (IDPOST)
        references POST (IDPOST)
        on delete restrict on update restrict;

alter table A_POUR_PHOTO
    add constraint FK_APHOTO_PHOTO foreign key (IDPHOTO)
        references PHOTO (IDPHOTO)
        on delete restrict on update restrict;

/*Liens de la table Commentaire*/

alter table COMMENTAIRE
    add constraint FK_COMMENTAIRE_POST foreign key (IDPOSTCOMMENTAIRE)
        references POST (IDPOST) 
        on delete restrict on update restrict;
   


/*Liens de la table Citation*/


alter table CITATION
    add constraint FK_CITATION_POST foreign key (IDPOSTCITATION)
        references POST (IDPOST)
        on delete restrict on update restrict;



/*Creation des vues */



CREATE OR REPLACE VIEW vrt AS

SELECT 
    rt.idrt, 
    rt.datert, 
    rt.idrtcompte, 
    co.pseudocompte AS "pseudocomptert",
    rt.idrtpost, 
    p.textpost, 
    p.datepost, 
    c.logincompte, 
    c.pseudocompte, 
    cp.urlphoto AS "urlppcompte", 
    array_agg(DISTINCT pho.urlphoto) AS photo_urls,
    COUNT(DISTINCT a.idaime) AS nblike, 
    COUNT(DISTINCT cm.idcommentaire) AS nbcomment,
    COUNT(DISTINCT rtn.idrt) AS nbrt  -- Compter les retweets pour ce post
FROM rt
JOIN post p ON rt.idrtpost = p.idpost
JOIN compte c ON c.idcompte = p.idcompte
JOIN compte co ON rt.idrtcompte = co.idcompte
JOIN photo cp ON cp.idphoto = c.idppcompte -- Photo de profil du compte
LEFT JOIN A_POUR_PHOTO ap ON ap.IDPOST = p.IDPOST
LEFT JOIN PHOTO pho ON pho.IDPHOTO = ap.IDPHOTO
LEFT JOIN AIME a ON a.idaimepost = p.idpost -- Comptabiliser les likes
LEFT JOIN COMMENTAIRE cm ON cm.idpostcommentaire = p.idpost -- Comptabiliser les commentaires
LEFT JOIN RT rtn ON rtn.idrtpost = p.idpost -- Comptabiliser les retweets du post
GROUP BY rt.idrt, rt.datert, rt.idrtcompte, co.pseudocompte, rt.idrtpost, p.textpost, p.datepost, c.logincompte, c.pseudocompte, cp.urlphoto;
  



create view vpost as
SELECT 
	p.idpost,
	textpost,
	datepost,
	p.idcompte,
	logincompte,
	pseudocompte,
	cp.urlphoto,
	array_agg(DISTINCT pho.urlphoto) AS photo_urls,
    COUNT(DISTINCT a.idaime) AS nblike, 
    COUNT(DISTINCT cm.idcommentaire) AS nbcomment,
	COUNT(DISTINCT rt.idrt) AS "nbrt"
from post p
JOIN compte c ON c.idcompte = p.idcompte
JOIN photo cp ON cp.idphoto = c.idppcompte
LEFT JOIN A_POUR_PHOTO ap ON ap.IDPOST = p.IDPOST
LEFT JOIN RT rt ON rt.idrtpost = p.idpost
LEFT JOIN PHOTO pho ON pho.IDPHOTO = ap.IDPHOTO
LEFT JOIN AIME a ON a.idaimepost = p.idpost -- Comptabiliser les likes
LEFT JOIN COMMENTAIRE cm ON cm.idpostcommentaire = p.idpost -- Comptabiliser les commentaires
GROUP BY p.idpost,textpost,datepost,p.idcompte,logincompte,pseudocompte,cp.urlphoto;

create view vcitation as
SELECT
    c.idcitation, 
    c.idpostcitation, 
    c.idpostcitationoriginal, 
    p.textpost, 
    p.datepost, 
    co.idcompte AS "idcompteposter",
    co.logincompte AS "loginposter",
    co.pseudocompte AS "pseudoposter",
    cpo.idcompte AS "idcompteoriginal",
    cpo.logincompte AS "logincompteoriginal",
    cpo.pseudocompte AS "pseudocompteoriginal",
    po.textpost AS "textpostoriginal",
    -- Photos du post original (po)
    array_agg(DISTINCT pho.urlphoto) AS "photosoriginal", 
    -- Photos du post cité (p)
    array_agg(DISTINCT pho2.urlphoto) AS "photoscitation",
    -- Nombre de likes, retweets et commentaires du post cité (p)
    COUNT(DISTINCT a.idaime) AS "nblike", 
    COUNT(DISTINCT rt.idrt) AS "nbrt", 
    COUNT(DISTINCT cm.idcommentaire) AS "nbcomment"
FROM citation c
JOIN post po ON po.idpost = c.idpostcitationoriginal
JOIN post p ON p.idpost = c.idpostcitation
JOIN compte cpo ON cpo.idcompte = po.idcompte
JOIN compte co ON co.idcompte = p.idcompte
-- Joins pour les photos des comptes
JOIN photo ppcpo ON ppcpo.idphoto = cpo.idppcompte
JOIN photo ppco ON ppco.idphoto = co.idppcompte
-- Joins pour les photos des posts
LEFT JOIN A_POUR_PHOTO ap1 ON ap1.idpost = po.idpost
LEFT JOIN PHOTO pho ON pho.idphoto = ap1.idphoto
LEFT JOIN A_POUR_PHOTO ap2 ON ap2.idpost = p.idpost
LEFT JOIN PHOTO pho2 ON pho2.idphoto = ap2.idphoto
-- Joins pour les likes, retweets et commentaires du post cité (p)
LEFT JOIN AIME a ON a.idaimepost = p.idpost
LEFT JOIN RT rt ON rt.idrtpost = p.idpost
LEFT JOIN COMMENTAIRE cm ON cm.idpostcommentaire = p.idpost
GROUP BY
    c.idcitation, 
    c.idpostcitation, 
    c.idpostcitationoriginal, 
    p.textpost, 
    p.datepost, 
    co.idcompte,
    co.logincompte, 
    co.pseudocompte,
    cpo.idcompte, 
    cpo.logincompte, 
    cpo.pseudocompte, 
    po.textpost;

INSERT INTO PHOTO (urlphoto) VALUES
('img/pp/bdiar.jpg'),
('img/pp/pytoka.jpg'),
('img/pp/isudus.jpg'),
('img/pp/bojodo.jpg'),
('img/pp/tkt.jpg'),
('img/baniere/bdiar.jpg'),
('img/baniere/pytoka.jpg'),
('img/baniere/isudus.jpg'),
('img/baniere/bojodo.jpg'),
('img/baniere/tkt.jpg'),


('img/post/chat.jpg'), --11
('img/post/banane.jpg'),
('img/post/oui.jpg'),
('img/post/chien.jpg'),
('img/post/saez.jpg');

INSERT INTO COMPTE (logincompte, pseudocompte, mdpcompte, descriptioncompte, idbanierecompte, idppcompte) VALUES
('bdiar', 'petit_loupblanc', '$2y$10$mPBTDmayLorcLIrvVaMoL.zsLO5Zx.ZVlN9FyvycKuhv0hYhhmygG', 'best prof', 6, 1),
('pytoka', 'Pytoka', '$2y$10$mPBTDmayLorcLIrvVaMoL.zsLO5Zx.ZVlN9FyvycKuhv0hYhhmygG', 'best eleve 1', 7, 2),
('isudus', 'Isudus', '$2y$10$mPBTDmayLorcLIrvVaMoL.zsLO5Zx.ZVlN9FyvycKuhv0hYhhmygG', 'best eleve 2', 8, 3),
('bojodo', 'Bojodo', '$2y$10$mPBTDmayLorcLIrvVaMoL.zsLO5Zx.ZVlN9FyvycKuhv0hYhhmygG', 'best eleve 3', 9, 4),
('tkt', 'Tkt', '$2y$10$mPBTDmayLorcLIrvVaMoL.zsLO5Zx.ZVlN9FyvycKuhv0hYhhmygG', 'best eleve 4', 10, 5);

INSERT INTO POST (textpost, datepost, idcompte) VALUES
-- Posts initiaux
('Je suis allé à la plage !', '28/03/2025', 1), -- post 1 par bdiar
('Regardez ce chat comme il est mignon !', '28/03/2025', 2), -- post 2 par pytoka 
('Je travaille sur un projet top secret !', '28/03/2025', 3), -- post 3 par isudus
('Les chiens sont vraiment les meilleurs compagnons !', '28/03/2025', 4), -- post 4 par bojodo
('Je suis allé dans un parc magnifique aujourd’hui.', '28/03/2025', 5), -- post 5 par tkt
('Les bananes sont vraiment sous-cotées, vous trouvez pas ?', '28/03/2025', 2), -- post 6 par pytoka
('J’ai trouvé un super café où l’on peut travailler tranquillement.', '28/03/2025', 1), -- post 7 par bdiar
('Ce chien que j’ai vu aujourd’hui avait un regard tellement mystérieux.', '28/03/2025', 3), -- post 8 par isudus

--citations

('Tellement !!!!!!', '29/03/2025', 1), -- reponse au post 2 par bdiar                  --9
('parle nous de ton projet', '30/03/2025', 2), -- reponse au post 3 par pytoka          --10
('Miam', '1/04/2025', 3), -- reponse au post 6 par isudus                               --11
('Ou ca ?', '29/03/2025', 4), -- reponse au post 7 par bojodo                           --12
('Wankil !!', '31/03/2025', 5), -- post 6 par tkt                                       --13


--commentaires

('Il est trop mignon !!', '29/03/2025', 1), -- commentaire au post 2 par bdiar                  --14
('C’est pas bon !!', '30/03/2025', 4), -- reponse au post 9 par bojodo          --15
('Je suis fan de wankil', '1/04/2025', 1), -- reponse au post 11 par bdiar                               --16
('C’est quoi ton projet dis nous !', '29/03/2025', 5), -- reponse au post 3 par tkt                           --17
('J’ai hate que ton projet sorte !', '31/03/2025', 5), -- post 6 par tkt                                       --18
('Tu developpes twitter ? ', '30/03/2025', 1);

-- Insertion des commentaires en tant que commentaires (référencés à des posts existants)
INSERT INTO COMMENTAIRE (IDPOSTCOMMENTAIRE, IDPOSTORIGINALCOMMENTAIRE) VALUES
(14,2),
(15,9),
(16,9),
(17,3),
(18,3),
(19,3);


INSERT INTO AIME (idaimecompte, idaimepost) VALUES
(1, 1), -- bdiar aime son propre post
(2, 1), -- pytoka aime le post de bdiar
(3, 2), -- isudus aime le post du chat
(4, 2), -- bojodo aime aussi le post du chat
(5, 3), -- tkt aime le post sur le projet
(1, 4), -- bdiar aime le post sur les chiens
(2, 5), -- pytoka aime le post sur le parc
(3, 6), -- isudus aime le post sur les bananes
(4, 7), -- bojodo aime le post sur le café
(5, 8), -- tkt aime le post sur le chien mystérieux
(2, 9), -- pytoka aime la citation "Tellement !!!!!!"
(3, 10), -- isudus aime la citation sur le projet
(4, 11), -- bojodo aime la citation "Miam"
(1, 12), -- bdiar aime la citation "Ou ça ?"
(5, 13); -- tkt aime "Wankil !!"


INSERT INTO RT (datert, idrtcompte, idrtpost) VALUES
('29/03/2025', 2, 1), -- pytoka retweete le post de bdiar sur la plage
('29/03/2025', 3, 2), -- isudus retweete le post du chat
('30/03/2025', 4, 3), -- bojodo retweete le projet top secret
('31/03/2025', 1, 5), -- bdiar retweete le parc magnifique
('01/04/2025', 2, 6), -- pytoka retweete la banane sous-cotée
('01/04/2025', 3, 7), -- isudus retweete le café
('01/04/2025', 4, 8), -- bojodo retweete le chien mystérieux
('02/04/2025', 5, 9), -- tkt retweete "Tellement !!!!!!"
('02/04/2025', 1, 10), -- bdiar retweete la citation sur le projet
('02/04/2025', 3, 12); -- isudus retweete "Ou ça ?"


INSERT INTO A_Pour_PHOTO(IDPOST, IDPHOTO) VALUES
(2,11),
(3,13),
(3,15),
(4,14),
(8,14),
(8,14);




-- Insertion des citations en tant que citations (référencées à des posts existants)
INSERT INTO CITATION (IDPOSTCITATION, IDPOSTCITATIONORIGINAL) VALUES 
(9,2),
(10,3),
(11,6),
(12,7),
(13,6);

INSERT INTO FOLLOW(IDCOMPTEFOLLOW, IDCOMPTEQUIFOLLOW) VALUES
(2,1),
(4,1),
(2,4),
(5,3),
(1,3),
(4,3),
(4,2),
(1,5),
(3,5);