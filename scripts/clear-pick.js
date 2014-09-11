var MongoClient = require('mongodb').MongoClient
    , format = require('util').format;
    
var week = +process.argv[2];
var user = process.argv[3];

console.log("week: " + week);
console.log("user: " + user);
  MongoClient.connect('mongodb://127.0.0.1:27017/picks', function(err, db) {
    if(err) throw err;
    
    db.collection('games', function(err, collection){
    collection.find({week: week}, function(err, cursor){
	cursor.toArray(function(err, docs){
		docs.map(function(doc){
        		console.log(doc);
			if(doc.picks[user]){
				delete doc.picks[user];
			}
      			collection.update({_id: doc._id},{$set:{picks:doc.picks}}, function(){console.log("Updated");});
    		});
	});
    });
    });   
    console.log("Update successfull");
});
