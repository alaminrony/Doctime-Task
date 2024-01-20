## Create Migration File

- [Updated User Migration file](https://github.com/alaminrony/Doctime-Task/blob/master/database/migrations/2014_10_12_000000_create_users_table.php).

- For Faster Query Performance I Applied Indexing in column birth_year & birth_month.
- $table->index('birth_year').
- $table->index('birth_month').

## Bulk Import Data

For uploading 100000 Data, I used Job Batching & Queue.


- [Create Jobs & job_batches table for handle Job Batching](https://github.com/alaminrony/Doctime-Task/blob/master/database/migrations/2024_01_19_111017_create_job_batches_table.php).
- [Logic wrtitten in BulkUploadController](https://github.com/alaminrony/Doctime-Task/blob/master/app/Http/Controllers/BulkUploadController.php).
- [Job Processed by UserCsvProcess](https://github.com/alaminrony/Doctime-Task/blob/master/app/Jobs/UserCsvProcess.php).

## Redis Configuraion

- Installing Redis Server, predis, & Set REDIS_CLIENT=predis in config/databse.php. 
- Update .env file Set CACHE_DRIVER=redis & SESSION_DRIVER=redis 
- Now Redis Cache prepare to use in my system. 


## User Data Fetching

I Used Repository, Service Pattern with Interface Implementation. For caching I used Redis Cache.

- Step 1) [Define Route in web.php](https://github.com/alaminrony/Doctime-Task/blob/master/routes/web.php).
- Step 2) [Create a UserController](https://github.com/alaminrony/Doctime-Task/blob/master/routes/web.php). 
   
   In This controller Has index method. I injected UserInterface in Constructor Magic method.

 
- Step 3) Inside the Service Folder, I created UserInterface,UserService class. I called UserInterface->getAllUserByPagination($request) method.
- Step 4) This UserInterface Implemented by UserService class. 
- Step 5) In UserService class,I injected UserRepositoryInterface in Constructor.
- Step 6) In UserService class, This getAllUserByPagination() method call to $this->userRepositoryInterface->getAllUserByPagination($request).   [UserService Link](https://github.com/alaminrony/Doctime-Task/blob/master/app/Service/UserService.php)
- Step 7) Inside the App/Repository folder UserRepository implements UserRepositoryInterface.
- Step 8) In UserRepository class,I injected User model in Constructor.Finally we reached our main Logical Destination [UserRepository Link](https://github.com/alaminrony/Doctime-Task/blob/master/app/Repository/UserRepository.php)
- Step 9) This UserRepository class, getAllUserByPagination() method return our Users data.
- Step 10) For Binding all Interface & Classess. I create a RepositoryServiceProvider & register it config/app/providers array. 
        Inside register  method I have written my binding code.[RepositoryServiceProvider Link](https://github.com/alaminrony/Doctime-Task/blob/master/app/Providers/RepositoryServiceProvider.php) 


## How I Fetched Data & Used Redis Cache ?

- Step 1) First of all, I generated a Redis key format using redisKeyGenerate() Method. 
          Format is "pagination:users:page_{$pageNo}_{$birth_year}_{$birth_month}"
 
        Here, I checked, If no page numner available in my url, then It would be 1. if user filter by birth_year then $redisKey concat this string.same as birth_month. And finally return Generated Key.

- Step 2) After getting $redisKey, I have checked, data is available in Redis cache? If yes then unserialize this cache data & return view file. 
        If no then fetched data from database with pagination 20 data per page. serialize data & set Redis with 60 second expiry time.
        I have already checked in Several times that the SQL Query do not take longer than 250ms. I have also Shown Executation time in view 
        file used microtime().
    
        Ex Code: Redis::setex($redisKey, 60, serialize($users));

- Step 3) For filtering I used laravel scoping feature, which has defined User Model. 
        this purpose, I create a scopeFilter() method. Inside this method, I checked, If Request birth_year is not empty. then add
        where condition with the column of birth_year. same as birth_month. & return this Query Object.



<div align="center">
  <h1 style="font-size: 3em;">Thank You 🙏</h1>
</div>        






