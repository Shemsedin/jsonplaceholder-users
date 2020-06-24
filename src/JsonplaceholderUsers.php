<?php
/**
 * Plugin Name: Jsonplaceholder Users
 * Version: 1.0
 * Description: Gets the data from an external api https://jsonplaceholder
 * .typicode.com, which holds dummy users data.  It further manipulates the
 * data and displays them in an HTML table.
 * Author: Shemsedin Callaki
 * <shemsedin.callaki@gmail.com>
 */
namespace JsonplaceholderUsers;

class JsonplaceholderUsers {

	/**
	 * @var string
	 */
	protected $path = '/test-url';
	/**
	 * Endpoint to send the request to
	 *
	 * @var [type]
	 */
	protected $endpoint = 'https://jsonplaceholder.typicode.com/users';

	/**
	 * Request method
	 *
	 * @var string
	 */
	protected $method = '';

	/**
	 * Arguments sent with the request
	 *
	 * @var array
	 */
	protected $arguments = [
		'method' => 'GET',
	];

	/**
	 * Request response
	 *
	 * @var [type]
	 */
	protected $response;

	/**
	 * Body response
	 *
	 * @var [type]
	 */
	protected $body;

	/**
	 * Headers sent with the request
	 *
	 * @var [type]
	 */
	protected $headers;

	/**
	 * Response code from the request
	 *
	 * @var [type]
	 */
	protected $responseCode;

	/**
	 * Response message from the request
	 *
	 * @var [type]
	 */
	protected $responseMessage;


	/**
	 * JsonplaceholderUsers constructor.
	 */
	public function __construct() {
		$this->method = strtoupper( $this->arguments['method'] );
		add_action( 'wp_enqueue_scripts', [ $this, 'js_enqueue' ] );
		add_action( 'parse_request', [ $this, 'custom_path' ] );
	}

	/**
	 * Run the app.
	 */
	public function run() {
		$this->response        = wp_remote_request( $this->endpoint, $this->arguments );
		$this->body            = wp_remote_retrieve_body( $this->response );
		$this->responseCode    = wp_remote_retrieve_response_code( $this->response );
		$this->responseMessage = wp_remote_retrieve_response_message
		( $this->response );
	}

	/**
	 * @return string
	 */
	public function getPath()
	: string {
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getEndpoint()
	: string {
		return $this->endpoint;
	}

	/**
	 * Get body of the response
	 *
	 * @return mixed
	 */
	public function getBody() {
		return $this->body;
	}

	/**
	 * Get response headers
	 *
	 * @return mixed
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * Get the response code
	 *
	 * @return mixed
	 */
	public function getResponseCode() {
		return $this->responseCode;
	}

	/**
	 * Get the response message
	 *
	 * @return mixed
	 */
	public function getResponseMessage() {
		return $this->responseMessage;
	}

	/**
	 * Get the response
	 *
	 * @return mixed
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @return array|string[]
	 */
	public function getArguments()
	: array {
		return $this->arguments;
	}

	/**
	 * Return true or false based on response code.
	 *
	 * @return bool
	 */
	public function isSuccess()
	: bool {
		return $this->getResponseCode() === 200;
	}

	public function js_enqueue() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'users_js', plugins_url( '/../assets/js/jsonplaceholder-users.js',
			__FILE__ ) );
		wp_enqueue_script( 'users_style', plugins_url( '/../assets/css/styles.css',
			__FILE__ ) );
		wp_localize_script( 'users_js', 'users_api', [
			'endpoint' => $this->endpoint,
		] );
	}

	public function custom_path()
	: bool {
		global $wp_query;
		$wp_query->is_404 = FALSE;
		if ( $_SERVER['REQUEST_URI'] === $this->getPath() ) {
			$wp_query->is_404 = FALSE;
			require_once( __DIR__ . '/../page-custom-page-template.php' );
			exit();
		}

		return FALSE;
	}

	public function tableHeader()
	: string {
		return <<<EOT
 <table class="table table-striped">
 <tr>
   <th>ID</th>
   <th>Name</th>
   <th>User Name</th>
   <th>Email</th>
 </tr>
EOT;
	}

	public function displayUsers()
	: string {
		if ( $this->isSuccess() ) {
			$html[] = $this->tableHeader();
			$body   = json_decode( $this->getBody() );
			foreach ( $body as $row ) {
				$html[] = '<tr><td><a class ="test" href="#">' . $row->id . '</a></td><td><a class ="test" href="#">'
				          . $row->name . '</a></td><td><a class ="test"href="#">' . $row->username
				          . '</a></td><td><a>' . $row->email . '</a></td></tr>';

			}
			$html[] = '</table>';

			return implode( $html );
		} else {
			echo 'There were some error while trying to get the data, details below:' .
			     is_wp_error( $this->getResponseMessage() );
		}
	}
}
