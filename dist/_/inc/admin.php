<?php

if (!Customer::adminLoggedIn()) {

	header('Location: /account');
}
