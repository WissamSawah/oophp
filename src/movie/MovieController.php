<?php
namespace Aisa\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
* A sample controller to show how a controller class can be implemented.
* The controller will be injected with $app if implementing the interface
* AppInjectableInterface, like this sample class does.
* The controller is mounted on a particular route and can then handle all
* requests for that mount point.
*
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;
    /**
    * @var string $db a sample member variable that gets initialised
    */
    // private $db = "not active";
    /**
    * The initialize method is optional and will always be called before the
    * target method/action. This is a convienient method where you could
    * setup internal properties that are commonly used by several methods.
    *
    * @return void
    */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //     // Use $this->app to access the framework services.
    // }
    /**
    * This is the index method action, it handles:
    * ANY METHOD mountpoint
    * ANY METHOD mountpoint/
    * ANY METHOD mountpoint/index
    *
    * @return string
    */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "active";
    }

    /**
    * Function to Show navbar.
    */
    public function head()
    {
        $this->app->page->add("movie/header");
    }

    public function initAction()
    {
        $title = "Show all movies";
        $this->head();
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);
        // $this->app->page->add("movie/movie_first");
        $this->app->page->add("movie/show-all", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function sortAction()
    {
        $title = "Show and sort all movies";
        $this->head();
        $this->app->db->connect();
        $orderBy =  $this->app->request->getGet("orderby") ?: "id";
        $order =  $this->app->request->getGet("order") ?: "asc";

        $sql = "SELECT * FROM movie ORDER BY $orderBy $order;";
        $resultset = $this->app->db->executeFetchAll($sql);
        $this->app->page->add("movie/show-all-sort", [
            "resultset" => $resultset,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function paginateAction()
    {
        $title = "Show, paginate movies";
        $this->head();
        $this->app->db->connect();
        $hits = $this->app->request->getGet("hits", 4);

        $sql = "SELECT COUNT(id) AS max FROM movie;";
        $max = $this->app->db->executeFetchAll($sql);
        $max = ceil($max[0]->max / $hits);

        $page = $this->app->request->getGet("page", 1);

        $offset = $hits * ($page - 1);

        $orderBy =  $this->app->request->getGet("orderby") ?: "id";
        $order =  $this->app->request->getGet("order") ?: "asc";


        $sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
        $resultset = $this->app->db->executeFetchAll($sql);
        $this->app->page->add("movie/show-all-paginate", [
            "resultset" => $resultset,
            "max" => $max,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function selectAction()
    {
        $title = "SELECT *";
        $this->head();
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $resultset = $this->app->db->executeFetchAll($sql);
        $this->app->page->add("movie/select", [
            "resultset" => $resultset,
            "sql" => $sql,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchTitleAction()
    {
        $title = "SELECT * WHERE title";
        $this->head();
        $this->app->db->connect();
        $searchTitle = $this->app->request->getGet("searchTitle");
        if ($searchTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
            $this->app->page->add("movie/search-title", [
               "searchTitle" => $searchTitle
               ]);
            $this->app->page->add("movie/show-all", [
               "resultset" => $resultset,
            ]);
        } else {
            $this->app->page->add("movie/search-title", [
               "searchTitle" => $searchTitle
            ]);
        }
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
    public function searchYearAction()
    {
        $title = "SELECT * WHERE year";
        $this->head();
        $this->app->db->connect();
        $year1 = $this->app->request->getGet("year1");
        $year2 = $this->app->request->getGet("year2");
        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
            $this->app->page->add("movie/search-year", [
                "year1" =>  $year1,
                "year2" =>  $year2
            ]);
                $this->app->page->add("movie/show-all", [
                "resultset" => $resultset,
                ]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
            $this->app->page->add("movie/search-year", [
                "year1" =>  $year1,
                "year2" =>  $year2
            ]);
            $this->app->page->add("movie/show-all", [
                "resultset" => $resultset,
            ]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
            $this->app->page->add("movie/search-year", [
                "year1" =>  $year1,
                "year2" =>  $year2
            ]);
            $this->app->page->add("movie/show-all", [
            "resultset" => $resultset,
            ]);
        } else {
            $this->app->page->add("movie/search-year", [
            "year1" =>  $year1,
            "year2" =>  $year2
            ]);
        }
        return $this->app->page->render([
        "title" => $title,
        ]);
    }

    public function editMovieActionGet($movieId)
    {
        $title = "Edit Movie";
        $this->head();
        $db = $this->app->db;
        $db->connect();
        $sql = "SELECT * FROM movie WHERE id = ?";
        $res = $db->executeFetchAll($sql, [$movieId]);
        $this->app->page->add("movie/movie-edit", [
            "res" => $res
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
    public function editMovieActionPost($movieId)
    {
        $db = $this->app->db;
        $db->connect();
        $movieId    = $this->app->request->getPost("movieId") ?: $this->app->request->getGet("movieId");
        $movieTitle = $this->app->request->getPost("movieTitle");
        $movieYear  = $this->app->request->getPost("movieYear");
        if ($movieYear == "") {
            $movieYear = 0;
        }
        $movieImage = $this->app->request->getPost("movieImage");

        if ($this->app->request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $db->executeFetchAll($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }
        $this->app->response->redirect("movie_one/init");
    }

    public function deleteMovieActionPost($movieId)
    {
        $this->app->db->connect();
        $movieId = $this->app->request->getPost("movieId");
        $sql = "DELETE FROM movie WHERE id = ?";
        $this->app->db->executeFetchAll($sql, [$movieId]);
        $this->app->response->redirect("movie_one/init");
    }
    public function deleteMovieActionGet($movieId)
    {
        $title = "Delete Movie";
        $this->head();
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE id = ?";
        $res = $this->app->db->executeFetchAll($sql, [$movieId]);
        $this->app->page->add("movie/movie-delete", [
            "res" => $res
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
    public function addMovieActionPost()
    {
        $title = "Add Movie";
        $this->app->db->connect();
        $this->head();
        $req = $this->app->request;
        $movieTitle = $req->getPost("movieTitle");
        $movieYear = $req->getPost("movieYear");
        $movieImage = $req->getPost("movieImage");
        $sql = "INSERT INTO movie (title, year, image)
            VALUES (?, ?, ?)";
            $this->app->db->executeFetchAll($sql, [$movieTitle, $movieYear, $movieImage]);
            $this->app->response->redirect("movie_one/init");
            return $this->app->page->render([
                "title" => $title,
            ]);
    }
    public function addMovieActionGet()
    {
        $title = "Add Movie";
        $this->head();
        $this->app->page->add("movie/movie-add");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function showMovieAction($movieId)
    {
        $title = "View Movie";
        $this->head();
        $db = $this->app->db;
        $db->connect();
        $sql = "SELECT * FROM movie WHERE id = ?";
        $res = $db->executeFetchAll($sql, [$movieId]);
        $this->app->page->add("movie/movie-view", [
            "res" => $res
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
