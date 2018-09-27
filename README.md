# Create a Speech Enabled Quiz Application and Dashboard using Cloudant and IBM Watson

## Description
This is an application meant for taking quizzes and monitoring them using a web interface based.
The application is based on Android and the web interface is based on PHP.
The entire system uses Cloudant NoSQL Database for the storage.
This can be used to create, take and manage quizzes which can be used at multiple areas such as workshops, schools, webinars etc.

## Learning Objectives
This guide shows you how can you deploy a PHP web application on IBM Cloud.
This also shows how to create, connect and manage a Cloudant database instance on IBM Cloud.
You will also learn how to fetch the required data from cloudant using search index queries.
Moreover, you will get to know the integration of IBM Cloudant DB and IBM Watson Speech to Text using Java SDK.

## Prerequisites
* An IBM Cloud Account. (You can create one here, and get 30 days free trial)
* IBM Cloud Command Line Interface
* GIT Command Line Interface
* Android Studio(3.1 and above)

## Estimated Time
These steps will take you approximately 90 minutes.This does not include creating an IBM Cloud account(if you don’t have one) or downloading the IBM Cloud CLI. It includes 10 minutes for creating cloudant service and generating credentials. Creating and the initial starting of PHP Service instance takes 10 minutes. Cloning the sample codes and doing the modifications can take you around 30 minutes. Deploying the code to the PHP Service using IBM Cloud CLI can take 10 minutes.
Deploying the app locally can take upto 10 minutes.


## Steps
In this guide you will perform following steps:
1. Creating a PHP Service on IBM Cloud.
2. Create a Cloudant Service on IBM Cloud and generate credentials.
3. Creating Database and Search Index in Cloudant DB
4. Cloning the two sample codes from GitHub.
5. Making necessary modifications in the PHP sample code before deployment.
6. Deploying local code to the PHP service using IBM Cloud CLI.
7. Modifying Android Sample Code.
8. Running the application.

# 1. Create a PHP Service

1. Go to **Catalog** from IBM Cloud homepage.
![Go To Catalog](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss1.png)

2. Select **Compute**.
![Click Compute](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss2.png)

3. Scroll down to **PHP** Service.
![Find and Select PHP Service](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss3.png)

4. After giving suitable app name and hostname click **Create** button to create a PHP Service.
![Click Create Button](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss4.png)

5. Once the service is running you can access it by clicking **Visit App URL**.
![Click Visit App URL](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss5.png)

# 2. Create Cloudant Service and Generating Credentials

1. Go to **Catalog** from IBM Cloud homepage.

2. Select **Databases**.
![Select Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss6.png)

3. Click **Cloudant** tile.
![Click Cloudant](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss7.png)

4. After giving suitable Service Name, in available authentication methods select **Use both legacy credentials and IAM** and then click **Create** button below to create the DB instance.
![Click Create](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss8.png)

5. Once the service is created you can access the Cloudant Dashboard by clicking **LAUNCH CLOUDANT DASHBOARD** button.
![Launch Cloudant Dashboard](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss9.png)

6. For creating service credentials select **Service Credentials**.
![Select Service Credentials](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss10.png)

7. Click on **New Credentials** Button.
![Click New Credentials](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss11.png)

8. After giving the suitable name to credentials, click **Add** button. This will generate credentials with the given name which will be used later to communicate with the DB.

# 3. Creating Database and Search Index in Cloudant DB

1. Go to **Manage** and **Launch Cloudant Dashboard**, this will take you to Cloudant dashboard. From here you can completely manage your database instance.
![Launch Cloudant Dashboard](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss12.png)

2. Go to **Databases**.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss13.png)


    * You will not be able to see any databases there when you open it for the first time.
    * For this application we will be creating following two databases:
      * Quizzes - This will be used to store all the details of quizzes that will be created by the admin.
      * User_responses - This will be used to store the quiz submissions by users for all quizzes.

3. Click Create Database.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss14.png)

4. After giving suitable name for the first database(for storing quizzes) click Create button.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss15.png)

5. Click on the first database which you have created to open the database
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss16.png)

6. Go to Plus Icon near Design Documents and Click New Search Index
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss17.png)

7. After giving suitable name to design document and search index, create following function definition in Search index Function:

```
function (doc) {
  index("quizid", doc.quizid);
}
```
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss18.png)


* This creates a search index for the database. We will be using this search index to check if the username already exists in the DB or not.

8. Scroll down and click Create Document and Build Index
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss19.png)

9. Now go back to cloudant dashboard and create the second database( Follow the same procedure of step 11 and 12).
After creating the second database, open the database by clicking the database name.

10. After creating the second database, open the database by clicking the database name.

11. Now we will create a search index for this database also.
To create a search index go to Plus Icon near Design Documents and Click New Search Index
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss20.png)

After giving suitable name to design document and search index, create following function definition in Search index Function:
```
function (doc) {
  index("email", doc.email);
}
```
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss21.png)

This creates a search index for the database. We will be using this search index to search with the email to check if the username already exists in the DB or not.

Scroll down and click Create Document and Build Index
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss22.png)


# 4. Cloning Sample Repositories
1. Accessing Git CLI
  * For windows Users: Open Git CMD
  * For Linux and Mac Users: Open Terminal
2. Use the following command to clone the PHP Web Interface sample repository
  * **$ git clone https://github.com/Ritwikjoshi/ibmquizsample**
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss23.png)


3. Use the following command to clone the Android Application sample code repository
  * **$ git clone https://github.com/bdbhavyadave/ibmquizsampleandroid**
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss24.png)


# 5. Modifying PHP Sample Code(repository cloned in the previous step2 of cloning sample repositories)
1. Open Credentials.php file in the cloned folder.

2. Replace Username, Password, Host, Database and Search Index Names in the file.
  * Note - dbname1, designdocument1, searchindex1 are for the database which will store the quizzes(the database we created first) and dbname2, designdocument2, searchindex2 are for the database which will store the user submissions(the database we created later).
  
3. Now, open the manifest.yml file located in the cloned folder and replace **<YOUR APPLICATION NAME HERE>** with your application name ( Name of the PHP Service you created in the beginning i.e “ibmsample”).

# 6. Deploying Application to IBM Cloud
1. Accessing IBM Cloud CLI
  * For Windows Users: Open Windows Command Prompt
  * For Linux and Mac Users: Open Terminal
2. For Confirming the installation of Ibmcloud cli use the following command:

  **$ ibmcloud -v**
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss25.png)

3. Login to IBM Cloud
  **$ ibmcloud login**
    * Authenticate using IBM Cloud Username and Password.
    
4. Switch to the directory having sample code and run the following command there:

  **$ ibmcloud app push**
  * This uses the manifest.yml file in the folder to target the application and the organisation.
  * If you get an error saying “No CF API endpoint set”  use the following command to correct it:
    **$ ibmcloud target --cf**
  * After setting the API Endpoint repeat **step 4**.
  
5. Once the Pushing is complete you’ll see app status as running on your command line.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss26.png)

6. You can check access the running application through the endpoint shown in the status.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss27.png)

# 7. Modifying Android Sample Code(repository cloned in the previous step 3 of cloning sample repositories)
1. Open [**Android Studio**](https://developer.android.com/studio/).

2. Open the cloned project inside the android studio.

3. Locate the **strings.xml** file at the given location : 
  **your android directory > apps > res > values > strings.xml**
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss28.png)

4. Replace Username, Password, Host, Database and Search Index Names in the file.
  * Note - cloudant_client_db1, cloudant_client_index1 are for the database which will store the quizzes(the database we created first) and cloudant_client_db2, cloudant_client_index2 are for the database which will store the user submissions(the database we created later).
  
5. Build the project.
  * There are multiple ways of building project in android studio. You can click **Green Hammer** Icon to build it directly.
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss29.png)


  * If the build is successful, you can check it out on the Build Window.
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss30.png)


  * In case the build is unsuccessful, it could be because of any kind of errors in the code which you might have caused during code modifications. Please check the code very carefully and after correcting the errors try rebuilding the project.

  * **Note -** In case if you encounter ‘Failed to resolve:’ error in the build window
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss31.png)

    * To resolve this error click on the File in upper left corner, go to settings 
    ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss32.png)


    * Then navigate to the following path:
      Build, Execution, Deployment > Gradle
      and uncheck the **Offline work** check box
      ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss33.png)

# 8. Running the Application
1. Before moving to the below steps, please make sure that you have **successfully built the project**.

2. There are multiple ways of running the built application. You can simply click **Green Triangle** on the toolbar to run the application.
![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss34.png)

3. As soon as you click the green triangle, Select Deployment Target window will appear on your screen. Here, you can select the device on which you want to run the application.
  * You can either select a device from the simulated devices of android studio(if you don’t have one you can [**create a new virtual device**](https://abhiandroid.com/androidstudio/create-avd-virtual-device-emulator-android-studio)) or you can run the application on a physical device connected to the system via USB(There are also some other ways of running the application on the physical device, if you are comfortable with them you are free to use any method to run the application).
  ![Go To Databases](https://github.com/Ritwikjoshi/ibmquiz/blob/master/src/images/screenshots/ss35.png)

  * In case of an USB connection, if you are not able to connect with the physical device then make sure your device is connected properly and USB Debugging is enabled in the device settings.(Refer this link for turning on USB Debugging in Android Devices)


## Summary
In this how-to guide you learned how to:
  * Creating PHP and Cloudant Services on IBM Cloud.
  * Creating Database and Querying Cloudant DB using Search Index.
  * Deploying application using IBM Cloud CLI.

## References
  * [**Video on Getting Started to Cloudant**](https://www.youtube.com/watch?v=BpQYOn8AVo0)
  * [**IBM Cloudant Documentation**](https://developer.ibm.com/clouddataservices/docs/cloudant/)
  * [**Android Studio beginners guide**](https://www.androidauthority.com/android-studio-tutorial-beginners-637572/)

