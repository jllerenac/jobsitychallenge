var tableEntries = '';
var pagcac = 0;

function addEntry()
{
    $('#addE').modal('show'); 
}
function queryEntries()
{
    var queryText = $('#queryText').val();
    $.ajax({
        type: "POST",
        url: ('Main/queryEntry'),
        data : {queryText: queryText},
        success: function(response)
        {
            document.getElementById("twt").innerHTML = "";
            document.getElementById("tabQuery").innerHTML = response;
            updatePagination('tableEntry',3,'pagEntry','paginationEntry');
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            jAlert('Error','MESSAGE');
        }
    });
}

function userPage(userId)
{
    var usrId = userId ;
    $.ajax({
        type: "POST",
        url: ('Main/userPage'),
        data : {userId: usrId},
        success: function(response)
        {
            document.getElementById("tabQuery").innerHTML = response;
            genTweets(usrId);
            updatePagination('tableEntry',3,'pagEntry','paginationEntry');
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            jAlert('Error','MESSAGE');
        }
    });
}

function genTweets(userId)
{
    var usrId = userId ;
    $.ajax({
        type: "POST",
        url: ('Main/genTweets'),
        data : {userId: usrId},
        success: function(response)
        {
            document.getElementById("twt").innerHTML = response;
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            jAlert('Error','MESSAGE');
        }
    });
}

function hideTweet(tweetId)
{
    var twtId = tweetId ;
    var twt = $('#userTweet'+twtId).text() ; 
    $.ajax({
        type: "POST",
        url: ('Main/hideTweet'),
        data : {tweetId: twtId, tweet: twt},
        success: function(response)
        {
            $('#hideId'+twtId).remove();
            $('#tweetRow'+twtId).append("<td id='showId"+twtId+"' style='padding: 0; cursor: pointer;' title='Show Tweet'><span onclick='showTweet(\""+twtId+"\")'><a href='#'>Show Tweet</a></span></td>");
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            jAlert('Error','MESSAGE');
        }
    });
}

function showTweet(tweetId)
{
    var twtId = tweetId ;
    $.ajax({
        type: "POST",
        url: ('Main/showTweet'),
        data : {tweetId: twtId},
        success: function(response)
        {
            $('#showId'+twtId).remove();
            $('#tweetRow'+twtId).append("<td id='hideId"+twtId+"' style='padding: 0; cursor: pointer;' title='Hide Tweet'><span onclick='hideTweet(\""+twtId+"\")'><a href='#'>Hide Tweet</a></span></td>");
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            jAlert('Error','MESSAGE');
        }
    });
}

function editEntry(entryId)
{
    $('#uEntryId').val($('#entryId'+entryId).text());
    $('#uEntryTitle').val($('#entryTitle'+entryId).text());
    $('#uEntryVal').val($('#entryValue'+entryId).text());
    $('#updE').modal('show');
}

function Pagination(tableName, itemsPerPage) {
    this.tableName = tableName;
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
    this.pages = 0;
    this.indexes = 0;
    this.currentindex = 1;
    this.perindex = 3;
    this.inited = false;
    this.paginacion = '';
    this.showRecords = function(from, to) {        
    var rows = document.getElementById(tableName).rows;
    // i starts from 1 to skip table header row
    for (var i = 1; i < rows.length; i++) {
        if (i < from || i > to)  
            rows[i].style.display = 'none';
        else
            rows[i].style.display = '';
    }
    };
    
    this.showIndex = function(from, to) {        
        var indice = '';
        // i starts from 1 to skip table header row
        for (var i = 1; i <= this.pages; i++) {
            indice = document.getElementById('pg'+ i);
            if (i < from || i > to)  
                indice.style.display = 'none';
            else
                indice.style.display = '';
        }
        this.showPage(from);
    };
    
    this.showPage = function(pageNumber) {
    	if (! this.inited) {
    		alert("not inited");
    		return;
    	}

        var oldPageAnchor = document.getElementById('pg'+this.currentPage);
        if (oldPageAnchor != null)
        {
            oldPageAnchor.className = 'pg-normal';
        }
        this.currentPage = pageNumber;
        switch(this.tableName) {
            case 'tableEntry':
                pagcac = pageNumber;
                break;
             }
        var newPageAnchor = document.getElementById('pg'+this.currentPage);
        if (oldPageAnchor != null)
        {
            newPageAnchor.className = 'pg-selected';
        }
        var from = (pageNumber - 1) * itemsPerPage + 1;
        var to = from + itemsPerPage - 1;
        this.showRecords(from, to);
    }   ;
    
    this.prev = function() {
        if (this.currentPage > 1)
            this.showPage(this.currentPage - 1);
    };
    
    this.prevf = function() {
        if (this.currentindex === 1)
            return false;
        switch(this.tableName) {
            case 'tableEntry':
                this.paginacion = 'pagEntry';
                break;
             }
        this.currentindex -= 1;
        var from = (this.currentindex - 1) * this.perindex + 1;
        var to = from + this.perindex - 1;
        this.showIndex(from, to);
        
    }  ;

    this.next = function() {
        switch(this.tableName) {
            case 'tableEntry':
                this.pages=tableEntries;
                if (this.currentPage !== pagcac) {this.currentPage = pagcac;}
                break;
            }
            
        if (this.currentPage < this.pages) {
            this.showPage(this.currentPage + 1);
        }
    };
    
    this.nextf = function() {
        if (this.pages <= 3 || this.currentindex >= this.indexes)
            return false;
        switch(this.tableName) {
            case 'tableEntry':
                this.paginacion = 'pagEntry';
                break;
             }
        this.currentindex += 1;
        var from = (this.currentindex - 1) * this.perindex + 1;
        var to = from + this.perindex - 1;
        this.showIndex(from, to);
        
    } ;
    
    this.init = function() {
        var rows = document.getElementById(tableName).rows;
        var records = (rows.length - 1); 
        this.pages = Math.ceil(records / itemsPerPage);
        this.indexes = Math.ceil(this.pages / this.perindex);
        switch(tableName) {
            case 'tableEntry':
                tableEntries=this.pages;
                break;
                          }
        this.inited = true;
    };

    this.showPageNav = function(pagerName, positionId) {
    	if (! this.inited) {
    		alert("not inited");
    		return;
    	}
        var oculta = ''; 
    	var element = document.getElementById(positionId);
        var pagerHtml = '<li onclick="' + pagerName + '.prevf();"><a href="#" aria-label="Previous 3"><span aria-hidden="true">&laquo;&laquo;</span></a></li>' ;
         pagerHtml += '<li onclick="' + pagerName + '.prev();"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>' ;
        for (var page = 1; page <= this.pages; page++) {
            if (page > 3){oculta = ' style = "display: none" ';} 
            pagerHtml += '<li ' + oculta + 'id="pg' + page + '" onclick="' + pagerName + '.showPage(' + page + ');"> <a href="#" >' + page + '</a> </li> ';     }     
        pagerHtml += '<li onclick="'+pagerName+'.next();"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a> </li>';
        pagerHtml += '<li onclick="'+pagerName+'.nextf();"><a href="#" aria-label="Next 3"><span aria-hidden="true">&raquo;&raquo;</span></a> </li>';
        element.innerHTML = pagerHtml;
    };
}

function updatePagination(tableName,perPage,pagEntry,paginationEntry)
{
    var pagina = document.getElementById(tableName);
    var pageri = new Pagination(tableName, perPage);
    pageri.init(); 
    pageri.showPageNav(paginationEntry,pagEntry); 
    pageri.showPage(1);
}

$(function() {
    $("button#insertEntry").click(function(){
        var entryTitle = $('#entryTitle').val();
        var entryVal = $('#entryVal').val();
        if (entryVal.length === 0 || entryTitle.length === 0 )
        {
            jAlert('No empty fields','MESSAGE');
            return false;  
        }
        $.ajax({
            type: "POST",
            url: ('Main/insertEntry'),
            data : {entryTitle: entryTitle, entryVal: entryVal},
            success: function(msg)
            {
                jAlert('Entry Inserted','MESSAGE');
                $('#addE').modal('hide'); 
                $("#rest").html(msg);
                queryEntries();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                jAlert('Error','MESSAGE');
            }
        });
    });

    $("button#updateEntry").click(function(){
        var entryId = $('#uEntryId').val();
        var entryTitle = $('#uEntryTitle').val();
        var entryVal = $('#uEntryVal').val();
        if (entryVal.length === 0 || entryTitle.length === 0 )
        {
            jAlert('No empty fields','MESSAGE');
            return false;  
        }
        $.ajax({
            type: "POST",
            url: ('Main/updateEntry'),
            data : {entryId: entryId, entryTitle: entryTitle, entryVal: entryVal},
            success: function(msg)
            {
                jAlert('Entry Updated','MESSAGE');
                $('#updE').modal('hide'); 
                $("#rest").html(msg);
                queryEntries();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                jAlert('Error','MESSAGE');
            }
        });
    });
});
