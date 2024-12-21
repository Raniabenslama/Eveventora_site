<?php

include_once('../database/connexion.php');
include_once('../models/user.php');

class UserController extends Connexion {
    public function __construct() {
        parent::__construct(); 
    }
    public function getUserByEmail($email) {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    

    // Méthode pour insérer un utilisateur
    public function insertUser(User $user) {
        try {
            $pdo = $this->getPDO();
            $query = "insert into user (nom, prenom, email, telephone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);

            // Hachage sécurisé du mot de passe avant l'insertion
            $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);

            return $stmt->execute([
                $user->getNom(), 
                $user->getPrenom(), 
                $user->getEmail(), 
                $user->getTelephone(), 
                $hashedPassword
            ]);
        } catch (Exception $e) {
            error_log("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour enregistrer un nouvel utilisateur
    public function registerUser($nom, $prenom, $email, $telephone, $password) {
        $user = new User(null, $nom, $prenom, $email, $telephone, $password);
        return $this->insertUser($user);
    }

    // Méthode pour mettre à jour un utilisateur
    public function updateUser(User $user) {
        try {
            $pdo = $this->getPDO();
            $query = "UPDATE user SET nom=?, prenom=?, email=?, telephone=?, password=? WHERE user_id=?";
            $stmt = $pdo->prepare($query);

            // Hachage sécurisé du mot de passe avant la mise à jour
            $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);

            return $stmt->execute([
                $user->getNom(),
                $user->getPrenom(),
                $user->getEmail(),
                $user->getTelephone(),
                $hashedPassword,
                $user->getUserId()  // Update based on new column name
            ]);
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour obtenir un utilisateur par ID
    public function getUserById($userId) {
        try {
            $pdo = $this->getPDO();
            $query = "SELECT * FROM user WHERE user_id=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new User(
                    $result['user_id'], 
                    $result['nom'], 
                    $result['prenom'], 
                    $result['email'], 
                    $result['telephone'], 
                    $result['password']
                );
            }
            return null;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
            return null;
        }
    }

    // Méthode pour supprimer un utilisateur
    public function deleteUser($userId) {
        try {
            $pdo = $this->getPDO();
            $query = "DELETE FROM user WHERE user_id=?";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([$userId]);
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }

    // Méthode pour chercher un utilisateur par nom
    public function searchUserByName($name) {
        try {
            $pdo = $this->getPDO();
            $query = "SELECT * FROM user WHERE nom LIKE ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(["%$name%"]);

            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new User(
                    $row['user_id'], 
                    $row['nom'], 
                    $row['prenom'], 
                    $row['email'], 
                    $row['telephone'], 
                    $row['password']
                );
            }
            return $users;
        } catch (Exception $e) {
            error_log("Erreur lors de la recherche des utilisateurs : " . $e->getMessage());
            return [];
        }
    }

    // Méthode pour obtenir tous les utilisateurs
    public function getAllUsers() {
        try {
            $pdo = $this->getPDO();
            $query = "SELECT * FROM user";
            $stmt = $pdo->query($query);

            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new User(
                    $row['user_id'], 
                    $row['nom'], 
                    $row['prenom'], 
                    $row['email'], 
                    $row['telephone'], 
                    $row['password']
                );
            }
            return $users;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
            return [];
        }
    }

    // Méthode pour authentifier un utilisateur
    public function loginUser($email, $password) {
        try {
            $pdo = $this->getPDO(); // Assurez-vous que getPDO() retourne une connexion PDO valide.
            $query = "SELECT * FROM user WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                // Vérifier le mot de passe
                if (password_verify($password, $user['password'])) {
                    unset($user['password']); // Supprimer le mot de passe avant de retourner les données
                    return [
                        'status' => 'success',
                        'message' => 'Connexion réussie.',
                        'user' => $user
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Mot de passe incorrect.'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Email introuvable.'
                ];
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la connexion : " . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Une erreur s\'est produite. Veuillez réessayer.'
            ];
        }
    }
    public function connexion($email, $password) {
        if (!empty($email) && !empty($password)) {
            $sql = $this->pdo->prepare('SELECT * FROM utilisateur WHERE email = ? AND password = ?');
            
            return $sql->execute([$email, $password]);
        }
        return false;
    }
  
    
    
    
}
?>
