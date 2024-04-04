# Gestion de Point de Vente pour Restaurant

Le projet vise à fournir un système complet de gestion de point de vente pour un restaurant, avec des fonctionnalités distinctes pour les utilisateurs clients et les administrateurs. Il est composé essentiellement d'un bloc Login, Client, Admin (email: admin@gmail.com, password : admin).

### Carte bancaire pour passer commande:
- **Numéro de carte:** 100100100
- **Code:** 123

### Fonctionnalités Principales :

- **Authentification et Inscription :** Permet aux utilisateurs de s'inscrire et de se connecter de manière sécurisée.
- **Filtrage de Produits :** Système de filtrage avancé pour rechercher des plats et des produits spécifiques.
- **Gestion des Clients :** L'administrateur peut consulter la liste des clients et prendre des mesures telles que le bannissement si nécessaire.
- **Statistiques de Vente :** Consultation des statistiques de vente des plats et produits pour une prise de décision éclairée.
- **Commandes Intuitives :** Les clients peuvent ajouter des commandes avec possibilité d'ajustement de la quantité des produits choisis. Le prix total est automatiquement mis à jour.
- **Génération de Factures :** Une fois la commande validée, le système génère une facture au format PDF.
- **Paiement Sécurisé :** Le paiement s'effectue en toute sécurité en saisissant les informations de la carte bancaire, vérifiées par une base de données sécurisée.
- **Historique d'Achats :** Suivi des achats précédents pour chaque client, offrant une expérience personnalisée.
- **Communication par E-mail :** Facilite la communication entre le client et l'administrateur par e-mail.

### Points Clés :

- **Génération de PDF des Commandes :** La génération des PDF des commandes passées par les clients est réalisée en PHP en utilisant la bibliothèque DOMPDF.
- **Fonctionnalité de Mail :**
   - De l'administrateur au client : La configuration du mail a été simplifiée en utilisant l'adresse e-mail gl.icious.team@gmail.com.
   - Du client à l'administrateur : En raison de la complexité de la configuration des e-mails pour chaque client, nous avons opté pour l'envoi des e-mails par gl.icious.team@gmail.com à lui-même, en mentionnant l'adresse e-mail de l'émetteur dans le message.
- **Page d'Administration :**
   - Les requêtes AJAX avec la fonction fetch() de JavaScript ont été utilisées pour la page d'administration (même pour le client).
   - La fonction setInterval a été employée pour mettre à jour les données et statistiques (état des commandes, charte graphique, nombre de clients) sans actualiser la page.
   - Nous avons organisé des fichiers PHP indépendants pour chaque fonctionnalité afin d'améliorer la structure du code.

### Hébergement du Site :
- Le site a été hébergé sur [https://www.gl-icious.infinityfreeapp.com](https://www.gl-icious.infinityfreeapp.com).
- Veuillez noter que la fonction de génération de PDF ne fonctionne correctement en ligne en raison de notre hébergeur (InfinityFree).

### Téléchargement des Fichiers :
Pour assurer le bon fonctionnement du mailing et de la génération de PDF, veuillez télécharger les dossiers à partir du [lien suivant](https://drive.google.com/drive/folders/1N1yO7qOEPOBPj5e612ON8FuSliargdPg) (si vous avez des problèmes à installer phpmailer et DOMPDF vous même) et assurez-vous qu'ils sont présents dans le répertoire du projet (avec les dossiers admin, client, login).

Regardez [cette vidéo explicative](https://www.youtube.com/watch?v=sKJ_Mzc7hM8&ab_channel=Mailmeteor) sur la configuration du mail avant de suivre les étapes suivantes.

Dans les fichiers sendEmail.php dans les dossiers Client et Admin, n'oubliez pas de remplacer :
- "Gmail of the company " par votre gmail
- "the password of the Gmail" par l'un des app passwords (générés par votre gmail)
