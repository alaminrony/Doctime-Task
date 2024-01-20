## Create Migration File

- [Updated User Migration file](https://github.com/alaminrony/Doctime-Task/blob/master/database/migrations/2014_10_12_000000_create_users_table.php).

- For Faster Query Performance I Applied Indexing in column birth_year & birth_month.
- $table->index('birth_year').
- $table->index('birth_month').

## Bulk Import Data

For uploading 100000 Data, I used Job Batching & Queue.


- [Create Jobs & job_batches table for handle Job Batching](https://github.com/alaminrony/Doctime-Task/blob/master/database/migrations/2024_01_19_111017_create_job_batches_table.php).
- [Logic wrtitten in BulkUploadController](https://github.com/alaminrony/Doctime-Task/blob/master/app/Http/Controllers/BulkUploadController.php).


## Redis Configuraion

- Installing Redis Server, predis, & Set REDIS_CLIENT=predis in config/databse.php. 
- Update .env file Set CACHE_DRIVER=redis & SESSION_DRIVER=redis 
- Now Redis Cache prepare to use in my system. 


## User Data Fetching

I Used Repository, Service Pattern with Interface Implementation. For caching I used Redis Cache.


- Installing Redis Server, predis, & Set REDIS_CLIENT=predis in config/databse.php. 
- Update .env file Set CACHE_DRIVER=redis & SESSION_DRIVER=redis 
- Now Redis Cache prepare to use in my system.




