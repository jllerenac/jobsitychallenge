<?php

class Entry_Model extends CI_Model {
    public function insertEntry($entryTitle,$entryVal)
    {
     $userId = $this->session->id;
     $this->db->query("call josellerena.insertEntry('$entryTitle','$entryVal',$userId);");
     $this->db->close();
    }
    public function updateEntry($entryId,$entryTitle,$entryVal)
    {
     $this->db->set('title', $entryTitle);
     $this->db->set('entry', $entryVal);
     $this->db->where('id', $entryId);
     $this->db->update('josellerena.user_entry');
     $this->db->close();
    }
    public function queryRecords()
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('josellerena.user_entry');
        return $query;
    }
    public function userPage($userId)
    {
        $this->db->order_by("id", "desc");
        $this->db->where('user_id', $userId);
        $query = $this->db->get('josellerena.user_entry');
        $this->genRows($query);
        $this->db->close();
        return $query;
    }
    public function queryEntry($entryValue)
    {
          if (!empty($entryValue)){
          $this->db->like('entry', $entryValue); }
          $this->db->order_by("id", "desc");
          $query = $this->db->get('josellerena.user_entry');
          $this->genRows($query);
          $this->db->close();
    }
    public function genRows($query) 
    {
        foreach ($query->result() as $row)
                { 
                    $userName = $this->db->query("select josellerena.obtain_username($row->user_id) as userName")->row();
                    $twitterUser = $this->db->query("select josellerena.obtain_twitterUser($row->user_id) as twitterUser")->row();
                    echo "<tr> 
                    <td style='padding: 0; display: none' id='entryId"."$row->id'>$row->id</td>
                    <td style='padding: 0;' id='entryTitle"."$row->id'>$row->title</td> 
                    <td style='padding: 0;' id='entryValue"."$row->id'>$row->entry</td> 
                    <td style='padding: 0;' id='twitterUser"."$row->id'>$twitterUser->twitterUser</td>
                    <td style='padding: 0;' id='entryDate"."$row->id'>$row->entry_date</td> 
                    <td style='padding: 0; display: none' id='userId"."$row->user_id'>$row->user_id</td>
                    <td style='padding: 0;' id='userName"."$row->id'>$userName->userName</td>";
                    if($this->session->id) 
                    {
                        echo "<td style='padding: 0; cursor: pointer;' title='Edit Entry'><span onclick='editEntry($row->id);' class='glyphicon glyphicon-edit' aria-hidden='true'></span></td> "; 
                    }
                    echo "<td style='padding: 0; cursor: pointer;' title='User Page'><span onclick='userPage($row->user_id);' class='glyphicon glyphicon-user' aria-hidden='true'></span></td> </tr>";
                }
    }
    public function genTweets($userId)
    {
        include("TwitterAPIExchange.php");
        echo "
            <div class='panel panel-default' style='margin-bottom: 0'>
                <div  class='panel-heading' style='padding: 0' >
                    <table  class='table table-bordered' id='tweetEntry' role='grid' style='font-size: 12px;'> 
                        <thead> 
                            <tr>  
                                <th style='padding: 0' class='col-xs-10'>Tweet</th> 
                            </tr> 
                        </thead> 
                        <tbody id ='tabTweet' > ";
                // you need to obtain your own keys 
                $settings = array(
                    'oauth_access_token' => "",
                    'oauth_access_token_secret' => "",
                    'consumer_key' => "",
                    'consumer_secret' => ""
                );
                $usrId = $userId ;
                $twitterUser = $this->db->query("select josellerena.obtain_twitterUser($usrId) as twitterUser")->row();
                $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                $variableGet = "?screen_name=$twitterUser->twitterUser&count=50";
                $requestMethod = 'GET';
                $twitter = new TwitterAPIExchange($settings);
                $tweets = json_decode($twitter->setGetfield($variableGet)
                             ->buildOauth($url, $requestMethod)
                             ->performRequest());
                foreach ($tweets as $uTweets)
                {
                    $checkHidden = $this->db->query("select josellerena.checkHidden($uTweets->id) as tweet")->row();
                    // here validate if user is accessing to his own tweets
                    // if is user tweets, it will show them otherwise it will show unhidden tweets regardless user
                    if ($this->session->id == $userId || $checkHidden->tweet == 0 )
                    {
                        echo "<tr id='tweetRow".$uTweets->id . "'> 
                        <td style='padding: 0; display: none' id='tweetId"."$uTweets->id'>$uTweets->id</td>
                        <td style='padding: 0;' id='userTweet"."$uTweets->id'>$uTweets->text</td> 
                        <td style='padding: 0; display: none' id='tUserId"."$userId'>$userId</td>";
                 
                        // here I ask again if is user's tweets so if it is, it will check if is hidden or not
                        if($this->session->id == $userId ) 
                        {
                            if ($checkHidden->tweet == '0') 
                            {
                                echo "<td id='hideId"."$uTweets->id' style='padding: 0; cursor: pointer;' title='Hide Tweet'><span onclick='hideTweet(\"$uTweets->id\")'><a href='#'>Hide Tweet</a></span></td> "; 
                            }
                            else
                            {
                                echo "<td id='showId"."$uTweets->id' style='padding: 0; cursor: pointer;' title='Show Tweet'><span onclick='showTweet(\"$uTweets->id\")'><a href='#'>Show Tweet</a></span></td> ";
                            }
                        }
                    }
                }
        echo "                
                </div>
            </div>";
    }
    // for hiding it will first check if record exist in table, if it doesnt, the record is inserted
    // if already exists, it will only update table setting hidden field to value of 1
    public function hideTweet($tweetId,$tweet)
    {
        $userId = $this->session->id;
        $this->db->query("call josellerena.hideTweet('$tweetId',\"$tweet\",$userId);");
        $this->db->close();
    }

    // to show tweet, the record will already exist, so it will only update hidden field to 0, and record will be kept in DB
    public function showTweet($tweetId)
    {
        $this->db->set('hidden', 0);
        $this->db->where('id', $tweetId);
        $this->db->update('josellerena.twitter');
        $this->db->close();
    }
}