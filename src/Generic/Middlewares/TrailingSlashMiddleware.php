<?php  
namespace Generic\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface
{

	public function process(
		ServerRequestInterface $request, RequestHandlerInterface $handler
		): ResponseInterface {

		//trouver l'url
		$url = $request->getUri()->getPath();

		//determiner le dernier caractère de l'url avec substr

		$lastCharacter = substr($url, -1);
		//$lastCharacter = $url[-1];
		// ou la syntaxe : $lastCharacter = $url[-1];

		//si le dernier caractère est un slash ("/")
		if($lastCharacter === '/'){
			//determiner la nouvelle url
			$newURL = substr($url, 0, -1);
			var_dump($newURL);

		//rediriger
		$response = new Response (301, [
			'location' => $newURL
		]);
		return $response;

	} else {
		//sinon on appelle le middleware suivant
		return $handler->handle($request);
	}
		var_dump($url);
		die('On est dans TrailingSlash Middleware');
	}

}

