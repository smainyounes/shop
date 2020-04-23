<?php 

	/**
	 * 
	 */
	class model_commande extends model_database
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Getters
		 */

		public function GetAll($page)
		{
			$limit = 10;
			$start = ($page - 1) * $limit;

			$this->query("SELECT * FROM shop_commandes LIMIT $limit OFFSET $start");

			return $this->resultSet();
		}

		public function Detail($id_commande)
		{
			$this->query("SELECT * FROM shop_commandes WHERE id_commande = :id");

			$this->bind(":id", $id_commande);

			return $this->single();
		}

		public function Products($id_commande)
		{
			$this->query("SELECT * FROM shop_produits_commander pc INNER JOIN shop_product p ON p.id_product = pc.id_produit WHERE id_commande = :id");

			$this->bind(":id", $id_commande);

			return $this->resultSet();
		}

		public function Filter($filter, $page)
		{
			$limit = 10;
			$start = ($page - 1) * $limit;

			$this->query("SELECT * FROM shop_commandes WHERE etat = :etat LIMIT $limit OFFSET $start");

			$this->bind(":etat", $filter);

			return $this->resultSet();
		}

		public function Nombre($filter = null)
		{
			if (!isset($filter)) {
				$this->query("SELECT COUNT(id_commande) nbr FROM shop_commandes");
				$res = $this->single();
				return $res->nbr;
			}else{
				$this->query("SELECT COUNT(id_commande) nbr FROM shop_commandes WHERE etat = :etat");

				$this->bind(":etat", $filter);

				$res = $this->single();
				return $res->nbr;
			}
		}

		/**
		 * Setters
		 */

		public function AddCommande()
		{
			if (empty($_POST['obs'])) {
				$_POST['obs'] = "";
			}

			$this->query("INSERT INTO shop_commandes(nom_complet, wilaya, commune, address, phone, observation, etat) VALUES(:nom, :wilaya, :commune, :address, :phone, :obs, :etat)");

			$this->bind(":nom", strip_tags($_POST['nom']));
			$this->bind(":wilaya", strip_tags($_POST['wilaya']));
			$this->bind(":commune", strip_tags($_POST['commune']));
			$this->bind(":address", strip_tags($_POST['address']));
			$this->bind(":phone", strip_tags($_POST['phone']));
			$this->bind(":obs", strip_tags($_POST['obs']));
			$this->bind(":etat", "encours");

			try {
				$this->execute();
				return $this->LastId();
			} catch (Exception $e) {
				return -1;
			}
			
		}

		public function AddProducts($id_commande, $basket)
		{
			$test = true;
			foreach ($basket as $prod) {
				$this->query("INSERT INTO shop_produits_commander(id_commande, id_produit, quantity) VALUES($id_commande, :prod, :qte)");

				$this->bind(":prod", $prod['id_prod']);
				$this->bind(":qte", $prod['qte']);
				try {
					$this->execute();
				} catch (Exception $e) {
					$test = false;
					break;
				}
			}

			if ($test) {
				return true;
			}else{
				$this->query("DELETE FROM shop_produits_commander WHERE id_commande = $id_commande");
				$this->execute();
				return false;
			}
		}

		public function UpdateState($id_commande, $stat)
		{
			$this->query("UPDATE shop_commandes SET etat = :stat WHERE id_commande = :id");

			$this->bind(":stat", $stat);
			$this->bind(":id", $id_commande);

			try {
				$this->execute();
				return true;
			} catch (Exception $e) {
				echo "$e";
				return false;
			}
		}
	}

 ?>