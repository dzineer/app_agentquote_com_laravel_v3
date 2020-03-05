<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use iamcal\SQLParser;
class DBExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dzexport {database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export database tool';

    protected $parser;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $database = $this->argument('database');

        list($servername, $username, $password, $dbname) = $this->getCurrentConnection();

        // Create connection
        $conn1 = new \mysqli($servername, $username, $password, 'migrations_agentquoter_store');
        $conn2 = new \mysqli($servername, $username, $password, 'backup_agentquoter_store');

        $connections = [];

        $connections[] = ["conn" => $conn1, "database" => 'migrations_agentquoter_store'] ;
        $connections[] = ["conn" => $conn2, "database" => 'backup_agentquoter_store'] ;

        foreach($connections as $connection) {
            // Check connection
            if ( $connection['conn']->connect_error ) {
                $this->error("Connection failed: ".$connection['conn']->connect_error);
            }
        }

        $dbs_struct = [];
        // $databases = $this->getDatabaseNames($conn);

        foreach($connections as $connection) {
            $db_struct = $this->getDatabaseInfo($connection['conn'], $connection['database']);
            // dnd($db_struct);
            $dbs_struct[] = $db_struct;
        }

        dd($dbs_struct);

        $dbs_struct[0];
        $dbs_struct[1];

        $final = $this->arrayMap(
            $dbs_struct[0][0],
            $dbs_struct[1][0]
        );

        dd($final);

        // var_dump(\json_encode($tables_struct));

        foreach($connections as $connection) {
            mysqli_close($connection['conn']);
        }

        $this->info('Connected successfully');
        $this->info('exporting database '  . $database . '...');
    }

    function arrayMap($schema1, $schema2) {
        return array_diff($schema1,$schema2);
    }

    function get_tables($conn)
    {
        $tableList = array();
        $res = mysqli_query($conn,"SHOW TABLES");
        while($cRow = mysqli_fetch_array($res))
        {
            $tableList[] = $cRow[0];
        }
        return $tableList;
    }

    /**
     * @return array
     */
    private function getCurrentConnection(): array
    {
        $servername = '127.0.0.1';
        $username = 'root';
        $password = '!g0dm@n!';
        $dbname = 'migrations_agentquoter_store';

        return [$servername, $username, $password, $dbname];
    }

    /**
     * @param \mysqli $link
     * @return array
     */
    private function getDatabaseNames(\mysqli $link): array
    {
        $databases = ['backup_agentquoter_store', 'backup_agentquoter_store'];

        return $databases;

        $sql = "SHOW DATABASES";

        if ( ! ($result = mysqli_query($link, $sql)) ) {
            printf("Error: %s\n", mysqli_error($link));
        }

        while ($row = mysqli_fetch_row($result)) {
            if ( ($row[0] != "information_schema") && ($row[0] != "mysql") ) {
                // echo $row[0]."\r\n";
                $databases[] = $row[0];
            }

        }
        return $databases;
    }

    /**
     * @param $conn
     * @param string $dbname
     * @return array
     */
    private function getDatabaseInfo($conn, string $dbname): array
    {
        $this->parser = new SQLParser();

        $tables = $this->get_tables($conn);

/*        echo "\n-----------------------------------\n";
        echo $dbname;
        echo "\n-----------------------------------\n";*/

        // dd($tables);
        $parsed_tables = [];
        foreach ($tables as $table) {

            $table_query = sprintf(" show create table %s", $table);

            if ( ! ($result = mysqli_query($conn, $table_query)) ) {
                printf("Error: %s\n", mysqli_error($conn));
            }

            while ($row = mysqli_fetch_row($result)) {
                /*            if ( ($row[0] != "information_schema") && ($row[0] != "mysql") ) {
                                echo $row[0]."\r\n";
                                $databases[] = $row[0];
                            }*/
                $this->parser->parse($row[1]);
            }
        }

        $parsed_tables  = $this->parser->tables;

        // dd($parsed_tables);

        $tables_struct = [];

        foreach ($parsed_tables as $table_name => $table_details) {

            // dd($table_name);

            $table_struct = new \stdClass();
            $table_struct->table = $table_name;
            // $table_struct->fields2 = [];
            $table_struct->database = $dbname;
            $table_struct->fields = $table_details["fields"];
            $tables_struct[] = $table_struct;
        }

        // dnd($tables_struct);

        return $parsed_tables;
    }
}
