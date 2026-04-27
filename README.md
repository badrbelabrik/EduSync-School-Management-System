
# 📘 EduSync – Système d'Authentification

EduSync est une application web développée en PHP permettant la gestion de l’inscription, de la connexion et de l’authentification des utilisateurs.
Le projet met en œuvre les bonnes pratiques de sécurité, notamment la gestion des sessions et la protection contre les attaques XSS.


## 🚀 Fonctionnalités

- 📝 Inscription d’un utilisateur (Nom, Prénom, Email, Mot de passe)

- ✅ Validation des champs côté serveur

- 🔐 Hashage des mots de passe avec password_hash()

- 🔑 Authentification avec vérification via password_verify()

- ⚠️ Gestion des erreurs (champs vides, email invalide, identifiants incorrects)

- 🧾 Gestion des sessions avec $_SESSION

- 🔒 Accès protégé au dashboard (contrôle d’accès)

- 🚪 Déconnexion sécurisée avec session_destroy()

- 🎨 Interface simple avec Tailwind CSS
## 🗂️ Structure du projet
edusync-backend/

├── public/

│       ├── index.php          
│       ├── login.php          
│       ├── register.php      
│       ├── dashboard.php     
│       └── assets/            


├── scripts/

│   ├── authprocess.php    
│   └── logout.php         


├── includes/

│   ├── header.php         
│   ├── footer.php       
│   ├── connection.php    
│   └── functions.php    
│
└── README.md
## 🛠️ Technologies utilisées
- PHP (procédural)

- MySQL (base de données)

- HTML5 / CSS3

- Tailwind CSS (via CDN)

- XAMPP / WAMP (environnement local)
## 🔐 Sécurité
✔ Hashage des mots de passe avec password_hash()

✔ Vérification sécurisée avec password_verify()

✔ Protection XSS avec htmlspecialchars() lors de l’affichage

✔ Nettoyage des entrées utilisateur avec trim()

✔ Utilisation de requêtes préparées (mysqli_stmt)

✔ Gestion sécurisée des sessions ($_SESSION)

✔ Régénération de l’ID de session après login (session_regenerate_id())
## ⚙️ Installation
1. Cloner le projet
git clone https://github.com/votre-repo/edusync.git

2. Placer le projet dans votre serveur local
XAMPP → htdocs/
WAMP → www/

3. Créer la base de données
- Nom : school_db

Tables

- roles: pk id, label
- users: pk id, firstname, lastname, email, password, fk id_role
- classes: pk id, name, classroom_number
- students: pk id, dateofbirth, student_number, fk id_classe, fk id_user
- courses: pk id, title, description, total_hours, fk id_prof
- enrollments: pk id, enrolled_at, status, fk id_student, fk id_course

4. Configurer la connexion

Dans includes/connection.php :

$con = mysqli_connect("localhost", "root", "", "school_db");

5. Lancer le projet

Ouvrir dans le navigateur :

http://localhost/edusync/public/index.php
## ✅ Remarque
Ce projet a été réalisé dans un objectif pédagogique afin de comprendre :

- la gestion des formulaires en PHP
- l’authentification utilisateur
- la sécurité web de base