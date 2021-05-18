<?php
require_once("../class/mysql.php");
class API extends Connection
{
    public function __construct()
    {
        Connection::__construct();
    }

    public function getAllUsers()
    {
        $arr = array();

        $query = "SELECT id, fullname FROM users";
        $res = self::$db->query($query);

        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }

        return $arr;
    }

    public function sendChat($msg, $senderId, $receiveId)
    {
        $query = "INSERT INTO chats (msg, id_users_sender, id_users_receive) VALUES (?,?,?)";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("sii", $msg, $senderId, $receiveId);
        return $stmt->execute();
    }

    public function getChat($senderId, $receiveId)
    {
        $query = "SELECT * FROM chats WHERE id_users_sender = ? AND id_users_receive = ? OR id_users_sender = ? AND id_users_receive = ? ";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("iiii", $senderId, $receiveId, $receiveId, $senderId);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }

        return $arr;
    }
}
