<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * DOMÍNIO
 *---------------------------------------------------------------
 * 
 * A Library 'Domínio' é usada para incluir automaticamente todas
 * as classes que são usadas no código, de forma semelhante ao
 * recurso Auto-load do CodeIgniter, com a vantagem de que
 * podemos escolher quando carregar ou não essas classes.
 *
 */

class Dominio {
	
	public function __construct()
	{
		require('Administrador.php');
		require('Categoria.php');
		require('Classificacao.php');
		require('Compra.php');
		require('Pedido.php');
		require('Produto.php');
		require('Propriedade.php');
		require('Prosumidor.php');
		require('Transacao.php');
		require('Venda.php');
	}
}

/* End of file Dominio.php */
/* Location: ./application/libraries/Dominio.php */