LastCommentExtended
===================


LastCommentExtended (LCE) est un plugin pour [Dotclear] (http://fr.dotclear.org/).

Ce plugin ajoute un widget permettant de lister les derniers commentaires du blog.

La présentation des informations est très paramètrable (voir plus bas).

Ce plugin est basé sur le plugin [Dcom] (http://plugins.dotaddict.org/dc2/details/dcom) de Oleksandr Syenchuk, Pierre Van Glabeke.


Auteurs
=======
Pierre Van Glabeke, Bernard Le Roux

Licence
===================
Ce plugin est placé sous la licence [GPL v2] (http://www.gnu.org/licenses/gpl-2.0.html).


Utilisation
===========

## Présentation du plugin et configuration

LastCommentExtended est un widget pour Dotclear 2.
Il permet d'afficher les derniers commentaires sur le blog, et d'affiner sa présentation.
Il est ainsi possible de fixer :
* le nombre de commentaires à afficher,
* la longueur maximale du titre du commentaire,
* la longueur maximale du commentaire,
* le format de la date (à partir de la version 2.6 de Dotclear, vous trouverez des exemples de formatage de date dans les paramètres de votre blog (/dotclear/blog_pref.php#date_format)),
* le format d'affichage du widget côté public.

![widget de présentation LCE, réglages par défaut](https://media.dotaddict.org/pda/dc2/LastCommentExtended/lce_widget.PNG)

Par défaut, le format d'affichage du widget est : `<a href="%5$s" title="%4$s">%2$s - %3$s<br/>%1$s</a>`, mais vous pouvez le modifier à votre convenance. Vous pouvez également entourer certaines parties du code avec des span afin de régler l'affichage via la css de votre thème.

Exemple : je veux que l'affichage des commentaires soit sur trois lignes. La première (en rouge) est composée de la date - heure - nom de l'auteur. En deuxième ligne, le titre (limité aux 40 premiers caractères) du billet ayant eu ce commentaire. En troisième ligne (en vert), les 80 premiers caractères du commentaire. Les options du widget seront à régler comme suit :
* longueur maximale du titre du commentaire : 40
* longueur maximale du commentaire : 80
* format de la date : `%d/%m - %H:%M`
* format d'affichage : `<a href="%5$s" title="%4$s"><span class="lceauthor">%1$s - %3$s</span><br/>%2$s<br /><span class="lcecomment">%4$s</span></a>`

Et dans la css :
`.lastcomments .lceauthor {color:red;}
.lastcomments .lcecomment {color:green;}`

Résultat :

![widget de présentation LCE](https://user-images.githubusercontent.com/5787951/210687309-b961d9cf-0c16-4981-8ff3-e7e9dfdb305d.jpg)