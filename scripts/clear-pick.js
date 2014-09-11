var MongoClient = require('mongodb').MongoClient
    , format = require('util').format;
    
var week = process.argv[2];
var user = process.argv[3];

  MongoClient.connect('mongodb://127.0.0.1:27017/picks', function(err, db) {
    if(err) throw err;
    
    var collection = db.collection('games');
    collection.find({week: week}).forEach(function(doc){
      delete doc.picks[user];
      collection.update({_id: doc._id},{$set:{picks:doc.picks}});
    )};
});
