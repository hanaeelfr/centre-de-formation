SELECT * FROM session WHERE date_début> = CURDATE ()
AND (date_début>= 01/01/2023 OR date_fin<= 05/05/2023)

SELECT t1.* FROM apprenant t1 INNER JOIN apprenant_session t2 on t1.id_app = t2.id_app INNER JOIN session t3 ON t3.id_session = t2.id_session WHERE t3.id_session=2;

SELECT * FROM formation F INNER JOIN session S ON S.id_formation = F.id_formation

SELECT * FROM formation F LEFT JOIN session S ON S.id_formation = F.id_formation

SELECT * FROM session S LEFT JOIN aprenant_session A ON S.id_session = A.id_session;

SELECT S.id_session,COUNT(S.id_session),S.place_max FROM session S LEFT JOIN aprenant_session A ON s.id_session = A.id_session GROUP BY S.id_session HAVING COUNT(S.id_session)<S.place_max;

SELECT * FROM session S WHERE S.id_formateur = S.id_formateur;

SELECT * FROM session WHERE id_formateur = 2 ORDER BY date_début ASC;

SELECT COUNT(*) FROM aprenant A INNER JOIN aprenant_session ap on A.id_aprenant=A.id_aprenant WHERE id_session =4;

SELECT COUNT(*) FROM session S INNER JOIN formateur F ON S.id_formateur = F.id_formateur WHERE S.date_début BETWEEN date_début AND date_fin OR S.date_fin BETWEEN date_début AND date_fin OR date_début BETWEEN S.date_début AND S.date_fin OR date_fin BETWEEN S.date_début AND S.date_fin;

SELECT f.catégorie , COUNT(f.catégorie) AS Nombre_session FROM formation f INNER JOIN session S ON f.id_formation=S.id_formation GROUP BY f.catégorie;


SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation INNER JOIN aprenant_session ASS ON S.id_session = ASS.id_session WHERE ASS.id_aprenant = '1' AND ASS.resultat = 'valider';
