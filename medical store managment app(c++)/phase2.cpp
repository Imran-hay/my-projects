#include<iostream>
#include<fstream>
#include<cstdlib>
#include<iomanip>
#include<string>
#include<vector>


using namespace std;
vector<string>names; //a vector to store the names of the drugs
vector<string>batchs; // avectot to store the batch number of drugs


int read_data_size() // a functions that reads the size of data.csv
{
    string size_1;
   
    
    ifstream input;
    input.open("size.csv");
    getline(input,size_1,',');
   
      int size1 = stoi(size_1);
     

      return size1;

      input.close();



}

int read_sale_size() // afunction that read the size of sales.csv
{
    string size_1;
    string size_2;
    
    ifstream input;
    input.open("size.csv");
    getline(input,size_1,',');
     getline(input,size_2,',');
      int size1 = stoi(size_1);
      int size2 = stoi(size_2);

      return size2;



}

void modify_data_size(int n)
{
        string size_1;
    string size_2;
    
   
    ifstream input;
      input.open("size.csv");
    getline(input,size_1,',');
     getline(input,size_2,',');

     int size1 = stoi(size_1);
      int size2 = stoi(size_2);
      input.close();

       ofstream output;
      output.open("size.csv");
      output << size1+(n) << ",";
      output << size2;

      output.close();




    
  
    
}


string str_input()
{
    string choice;
    getline(cin, choice);
     if(cin.good()== 0)
       {
           for(int i = 3 ; i > 0 ; i--)
           {
                 cin.clear();
            cin.ignore();
            cout << "error input" << endl;
            
        cout << "you have " << i-1 << " chance" << endl;
        cin >> choice;
        if(cin.good() != 0)
        {
            break;
        }
        

        

       
        else if(i == 2)
        {
           cout << "you have lost your chance" << endl;
           terminate();
       

           



        }
           }
       }
          
return choice;

}
int int_input() // a function that checks the readability of intgers
{
    int choice;
    cin >> choice;
     if(cin.good()== 0)
       {
           for(int i = 3 ; i > 0 ; i--)
           {
                 cin.clear();
            cin.ignore();
            cout << "error input" << endl;
            
        cout << "you have " << i-1 << " chance" << endl;
        cin >> choice;
        if(cin.good() != 0)
        {
            break;
        }
        

        

       
       if(i == 1)
       {
           cout << "you have lost your chance" << endl;
           system("pause");
       

           



        }
           }
       }
          
return choice;

}

  void admin_login()  // grant access for admin
  {
      cout << "enter your user name" << endl;
      string username;
      string password;
      ifstream input("admin_u.csv");
      
        getline(input,username,',');
        getline(input,password,'\n');

      
      string user_trial; //trial for username
      string pass_trial;//trial for password
      
      cin.clear();
       cin >> user_trial ;
      if(username == user_trial)
      {
          cout << endl;
      }
      else
      {
          for(int i = 3 ; i >= 0 ; i--)
          {
              cout << "incorrect user name" << endl;
              cout << "you have " << i-1 << "chance" << endl;
              cin.clear();
              cin.ignore();
              cin >> user_trial;
              if(username == user_trial)
              {
                  cout  << endl;
                  break;
              }
              else if(i == 2)
              {
                  cout << "you lost your chance" << endl;
                  
                  terminate();
              }
          }
      }
  

      cout << "enter your password" << endl;
      cin.clear();

      cin >> pass_trial;
      if(password == pass_trial)
      {
          cout << "welcome" << endl;
      }
      else
      {
          for(int j = 3 ; j >= 0 ; j--)
          {
              cout << "incorrect password" << endl;
              cout << "you have " << j-1 << "chance" << endl;
              cin.clear();
              cin.ignore();
              cin >> pass_trial;
              if(password == pass_trial)
              {
                  cout << "welcome" << endl;
                  break;
              }
           

              else if(j == 2)
              {
                  cout << "you lost your chance" << endl;
                terminate();
              }
          }
      }
  }
   void user_login()
  {
      cout << "enter your user name" << endl;
      string username;
      string password;
      ifstream input("user.csv");
      
        getline(input,username,',');
        getline(input,password,'\n');

      
      string user_trial;
      string pass_trial;
      
      cin.clear();
       cin >> user_trial ;
      if(username == user_trial)
      {
          cout << endl;
      }
      else
      {
          for(int i = 3 ; i >= 0 ; i--)
          {
              cout << "incorrect user name" << endl;
              cout << "you have " << i-1 << "chance" << endl;
              cin.clear();
              cin.ignore();
              cin >> user_trial;
              if(username == user_trial)
              {
                  cout  << endl;
                  break;
              }
              else if(i == 2)
              {
                  cout << "you lost your chance" << endl;
                  
                  terminate();
              }
          }
      }
  

      cout << "enter your password" << endl;
      cin.clear();

      cin >> pass_trial;
      if(password == pass_trial)
      {
          cout << "welcome" << endl;
          cout << endl;
      }
      else
      {
          for(int j = 3 ; j >= 0 ; j--)
          {
              cout << "incorrect password" << endl;
              cout << "you have " << j-1 << "chance" << endl;
              cin.clear();
              cin.ignore();
              cin >> pass_trial;
              if(password == pass_trial)
              {
                  cout << "welcome" << endl;
                  cout << endl;
                  break;
              }
           

              else if(j == 2)
              {
                  cout << "you lost your chance" << endl;
                terminate();
              }
          }
      }
  }

  void drugs() // a function that stores names and batch in the above declared functions
  {
        int s= read_data_size();
        string name,batch,cost,price,quantity,expiry,sales;
        ifstream input;
        int count = 0;
        input.open("data.csv");

         for(int i = 0 ; i < s; i++)
      {
          count++;
          
          
          getline(input,name,',');
          
          getline(input,batch,',');

          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');
          names.push_back(name);
          batchs.push_back(batch);
    
          
          
 
     

          




  }

  }

  void check_name( string &dname) // checks if the name is in the names vector
  {
       drugs();
      bool check = false;
      for(int i = 0 ; i < sizeof(names); i++)
      {
          if(dname == names[i])
          {
              cout << "drug found" << endl;
              check = true;
              break;
          }
      }

      for(int j = 3 ; j >= 0 ; j--)
      {
          if(check == false)
          {

          
          cout << "the drug was not found" << endl;
          cout << "try again you have " << j-1 << " chance" << endl;
          cin.clear();
          cin.ignore();
          cin >> dname;
               for(int i = 0 ; i < sizeof(names); i++)
      {
          if(dname == names[i])
          {
              cout << "drug found" << endl;
              check = true;
              break;
          }
          else
          {
              check = false;
          }
          

      }

      if(j == 2)
      {
          cout << "you lost your chance" << endl;
          terminate();

      }

      }

      }
     
     
     




  }

  void check_name2(string name)
  {
      drugs();
      bool check = true;
      for(int i = 0 ; i < sizeof(names); i++)
      {
          if(name == names[i])
          {
            
              check = false;
              break;
          }
      }

      for(int j = 3 ; j >= 0 ; j--)
      {
          if(check == false)
          {

          
          cout << "the drug already exists" << endl;
          cout << "try again you have " << j-1 << " chance" << endl;
          cin.clear();
          cin.ignore();
          cin >> name;
               for(int i = 0 ; i < sizeof(names); i++)
      {
          if(name == names[i])
          {
           
              check = false;
              break;
          }
          else
          {
              check = true;
          }
          

      }

      if(j == 2)
      {
          cout << "you lost your chance" << endl;
          terminate();

      }

      }

      }

  
     
     

     
     

  }

    

  void display_all()  // display all drug information
  {
  
      int s = read_data_size();
      cout << s;

     
       string name,batch,cost,price,quantity,expiry,sales;
        ifstream input;
        int count = 0;
        input.open("data.csv");

      


       for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
          getline(input,name,',');
          
          getline(input,batch,',');

          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');

    
    
          
          
             cout << setw(10) << name   << setw(15) << batch  << setw(15) << cost << setw(15);
      cout <<setw(15) << price << setw(15)<<  quantity  << setw(15) << expiry << setw(15) << sales  << endl;
     

          




  }


  input.close();
  cout << endl;

  cout << setw(25) << "key" << endl;
  cout  << "cost and price are interms of birr" << endl;
  cout << "cost = the price at which the company bought the medicine" << endl;
  cout  << "price = the price at which the company will sell the medicine" << endl;
  cout << "quantity is interms of crate and 1 crate = 100 strip of medicine" << endl;

  }

  
      
     
  void low_quantity()
  {
      int s = read_data_size();

  
      int count = 0;
      int x;
      
      cout << "this medicine are low in quntity" << endl;
      cout << setw(20) << "name" << setw(35) << "Quantity" << endl;
       string name,batch,cost,price,expiry,sales,quantity;
       
      ifstream input("data.csv");





         
      
       for(int i = 0 ; i < s ; i++)
      {
          count = count + 1;
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');

        



         



      
        
          if( count > 1)
          {
           
                   
                 x= std::stoi(quantity); // changing string to intger
                
        
               

                 
                   
                   

              
             
          }

          
          
          getline(input,expiry,',');
          getline(input,sales,'\n');
        
         
          
                if(x < 100 && count > 1)
                {
          
              cout <<setw(20) << name << setw(35) << x << endl;
              
            
          }

        
        
          
      }
        


  }

  void insert() // a funvtion to record new drug information
  {
     
      
      cout << "how many drugs you want to record" << endl;
      int n;//how many drugs
      int k = 1; // to modify size by 1
      n = int_input();
    string sname[n],batch[n],cost[n],price[n],quantity[n],expiry[n],sales[n];
      ofstream output;
      output.open("data.csv",std::ios::app);
      for(int i = 0 ; i < n ; i++)
      {
          cout <<i+1 <<  ": enter the name of the drug" << endl;
          cin >> sname[i];
          check_name2(sname[i]);
          
          names.push_back(sname[i]);
          output << sname[i] << ",";
           cout<<i+1 << ": enter the batch number of the drug " << endl;
           cin >> batch[i];
            names.push_back(batch[i]);
          output << batch[i]<< ",";
           cout<<i+1 << ": enter the cost of the drug" << endl;
           cin >> cost[i];
          output << cost[i]<< ",";
            cout<<i+1 << ": enter the price of the drug" << endl;
            cin >> price[i];
          output << price[i]<< ",";
            cout<<i+1 << ": enter the quantity of the drug" << endl;
            cin >> quantity[i];
          output << quantity[i]<< ",";
              cout<<i+1 << ": enter the expire date of the drug" << endl;
              cin >> expiry[i];
          output << expiry[i]<< ",";
              cout<<i+1 << ": enter the amount sold" << endl;
              cin >> sales[i];
          output << sales[i]<< "\n";

          cout << "drug successfully added" << endl;
            modify_data_size(k);
       
      
          
          
          

      }
   
      output.close();

    
     

    




  }

  void total_sales()  // displays total sales
  {
      int s = read_data_size();  //getting the size of data
      int x;
      int total = 0;
        string name,batch,cost,price,quantity,expiry,sales;
        ifstream input;
        int count = 0;
        input.open("data.csv");

      for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');

          if(count == 1)
          {
              cout << setw(20) << "name" << setw(30) << "amount_sold" << endl;
          }
          if(count > 1)
          {
              
              
                  x = stoi(sales);
                  total = total + x;
                  cout << setw(20) << name << setw(30) << x << endl;
              
          }

        
          
          
  
     

          




  }
    cout << "the total number of drugs sold is " << total << endl;


  input.close();

  }

  void total_profit()
  {
      int s = read_data_size();
       string name,batch,cost,price,quantity,expiry,sales;
       float profit;// store individual profit
       float t_profit = 0; // store total profit
       float i_price; // store the intger value of price
       float i_cost;// store the intger value of cost
       float i_quantity; //store intger  value of quantity

        ifstream input;
        int count = 0;
        input.open("data.csv");

        for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');
            if(count == 1)
          {
              cout << setw(20) << "name" << setw(30) << "profit" << endl;
          }
          if(count > 1)
          {
              
              
                  i_price = stoi(price);
                   i_cost = stoi(cost);
                    i_quantity = stoi(quantity);

                  profit = i_quantity* (i_price - i_cost);
                  t_profit = t_profit + profit;
                  cout << setw(20) << name << setw(30) << profit << endl;
              
          }
          
          
      

          




  }
   cout << "the total profit of the company is " <<t_profit << endl; 


  input.close();

  }

  void stastical_report()
  {
      int s= read_data_size();
      
       string name,batch,cost,price,quantity,expiry,sales;
        ifstream input;
        int count = 0;
          float profit;//store individual profit
          float revenue;//store individual revemue
          float t_revenue = 0;// store total revenue
       float t_profit = 0;// store total profit
       float i_price;//store integer value of price
       float i_cost;//store integer value of cost
       float i_quantity;//store integer value of quantity
       float i_sales;//store integer value of sales
        input.open("data.csv");

        for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');
                  if(count == 1)
          {
               cout << setw(15) << "name" << setw(24) << "amount_sold" <<setw(25) << "revenue" << setw(25) << "profit" << endl;
          }
          if(count > 1)
          {
                 
                  i_price = stoi(price);
                   i_cost = stoi(cost);
                    i_quantity = stoi(quantity);
                    i_sales = stoi(sales);

                    revenue = i_quantity * i_sales;
                    t_revenue = t_revenue + revenue;

                  profit = i_quantity* (i_price - i_cost);
                  t_profit = t_profit + profit;
                  cout << setw(15) << name << setw(24) << sales <<setw(25) << revenue << setw(25) << profit << endl;

              
              
             
              
          }
          
          
  
     

          




  }
  cout << "the total revenue of the company is " << t_revenue << endl;
  cout << "the total profit of the company is " << t_profit << endl;


  input.close();

  }

  void search() 
  {
        int s= read_data_size();
         string name,batch,cost,price,quantity,expiry,sales;
        ifstream input;
        ofstream output;
        int count = 0;
        input.open("data.csv");
     
        int choice;
         string n; // store name of drug we get from user
           string b;//store batch number of drug we get from user
           bool check;
            bool check1;
        cout << "choose 1 option below" << endl;
        cout << "1.search by name" << endl;
        cout << "2.search by batch number" << endl;


        
        choice = int_input();
        switch (choice)
        {
            case 1:
            {
                cout << "enter the name of the drug" << endl;
               
                cin >> n;
                break;
            }

            case 2:
            {
                  cout << "enter the batch number of the drug" << endl;
              
                cin >> b;
                break;

            }
        }
      


          for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');

    

          if(count > 1 && choice == 1)
          {
              if(n == name)
              {
                cout << setw(15) << "name"   << setw(18) <<"batch_num"  << setw(21) << "cost" << setw(25);
      cout << "quantity"  << setw(20) << "expire_date" << setw(20) << "amount_sold"  << endl;

                  check = true;
                         cout << setw(15) << name   << setw(18) << batch  << setw(21) << cost << setw(25);
      cout << quantity  << setw(20) << expiry << setw(20) << sales  << endl;
      break;


              }
              else
              {
                  check = false;
                  
                 // cout << "the drug was not found" << endl;
       
                      
                  
              }
                         if(i == s -1 && check == false)
              {
                  cout << "the drug was not found" << endl;

              }
                   
          
              
          }

             else if(count > 1 && choice == 2)
          {
              if(b == batch)
              {
                cout << setw(15) << "name"   << setw(18) <<"batch_num"  << setw(21) << "cost" << setw(25);
                 cout << "quantity"  << setw(20) << "expire_date" << setw(20) << "amount_sold"  << endl;
                  check1 = true;
                         cout << setw(15) << name   << setw(18) << batch  << setw(21) << cost << setw(25);
      cout << quantity  << setw(20) << expiry << setw(20) << sales  << endl;
      break;


              }
              else
              {
                  check1 = false;
                 // cout << "the drug was not found" << endl;
          
                      
                  
              }
                           if(i == s -1 && check1 == false)
              {
                  cout << "the drug b was not found" << endl;

              }
           
             
          
          }


          
          
          
  
     

          



  }
  input.close();


  }

  void delete_drug()
  {
        int s= read_data_size();
         int s1= read_sale_size();
    
      
       string name,batch,cost,price,quantity,expiry,sales;
       string dname; //drug name prompted from user
        ifstream input;
        int count = 0;
        input.open("data.csv");
        ofstream output;
        output.open("new.csv");
        cout << "enter the name of the drug" << endl;
        cin >> dname;
        check_name(dname);
       


         for(int i = 0 ; i < s ; i++)
      {
          count++;
          
          
        
          
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');
          if(dname != name && i < s - 1 )
          {
             output << name << ",";
            output << batch << ",";
            output << cost << ",";
            output << price<< ",";
            output << quantity << ",";
            output << expiry << ",";
            output << sales << "\n";

          }


      

         

          


          
          
        
     

          




  }

    


  input.close();
  output.close();
  remove("data.csv");
  rename("new.csv","data.csv");

  cout << "the drug has been successfully deleted" << endl;

    
      output.open("size.csv");
      output << s-1 << ",";
      output << s1;
      output.close();

         for(int i=0 ; i < sizeof(names); i++)
                  {
                      if(names[i] == dname)
                      {
                          names.erase(names.begin() + (i+1));
                          break;

                      } 
    
                      
                  } 


  }

  void update()  // update drug information
  {
        int s= read_data_size();
       string name,batch,cost,price,quantity,expiry,sales;
       string dname;//name of drug prompted from user
    
        ifstream input;
        int count = 0;
        input.open("data2.csv");

        ofstream output;
        output.open("new.csv");

        cout << "enter the name of the drug" << endl;
        cin >> dname;
        check_name(dname);
        cout << "dname:" << dname << endl;

        cout << "what would you like to update" << endl;
        cout << "1.name" << endl;
        cout << "2.batch number" << endl;
        cout << "3.cost" << endl;
        cout << "4.price" << endl;
        cout << "5.quantity" << endl;
        cout << "6.expire date" << endl;
        cout << "7.amount sold" << endl;

          int choice;
          string new_name;
          string new_batch;
          string new_cost;                    // store updated values
          string new_price;
          string new_quantity;
          string new_expire;
          string new_sales;

          choice = int_input();
          switch (choice)
          {
              case 1:
              {
                  cout << "enter the new name" << endl;
                  cin >> new_name;
                  break;
              }

              case 2:
              {
                   cout << "enter the new batch number" << endl;
                  cin >> new_batch;
                  break;
              }

              case 3:
              {
                   cout << "enter the new cost" << endl;
                  cin >> new_cost;
                  break;
              }

              case 4:
              {
                   cout << "enter the new price" << endl;
                  cin >> new_price;
                  break;
              }

              case 5:
              {
                   cout << "enter the new quantity" << endl;
                  cin >> new_quantity;
                  break;
              }

              case 6:
              {
                   cout << "enter the new expire date" << endl;
                  cin >> new_expire;
                  break;
              }

              case 7:
              {
                   cout << "enter the new value" << endl;
                  cin >> new_sales;
                  break;
              }
          }

          

         for(int i = 0 ; i < s; i++)
      {
          count++;
          
          
          
        
          
          
          
          getline(input,name,',');
      
          getline(input,batch,',');
          
       
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');

               if(choice == 1 && name == dname)
          {
              name = new_name;
          }

              if(choice == 2 && name == dname)
          {
              batch = new_batch;
          }
         
          

         
          

          if(choice == 3 && name == dname)
          {
              cost = new_cost;
          }
          else if(choice == 4 && name == dname)
          {
              price = new_price;
          }

          else if(choice == 5 && name == dname)
          {
              quantity = new_quantity;
          }
         else if(choice == 6 && name == dname)
          {
              expiry = new_expire;
          }
         else if(choice == 7 && name == dname)
          {
              sales = new_sales;
          }
          
         
         
         
         
         
         
         
          
             output << name << ",";
            output << batch << ",";
            output << cost << ",";
            output << price<< ",";
            output << quantity << ",";
            output << expiry << ",";
            output << sales << "\n";

          


    

         

          



  }


  input.close();
  output.close();
  remove("data.csv");
  rename("new.csv","data.csv");

  cout << "the data has been successfully updated" << endl;
     
      
  }  

  void display_sales()       // display all sale record
  {
        int s= read_sale_size();
      
      string name,quantity,buyer,date;
      ifstream input;
      input.open("sales.csv");
       for(int i = 0 ; i < s  ; i++)
      {
          getline(input,name,',');
          getline(input,quantity,',');
          getline(input,buyer,',');
          getline(input,date,'\n');

          cout << setw(10) << name <<  setw(30) << quantity << setw(30) << buyer << setw(40) << date << endl;
      }

      input.close();
  }


  void add_sale()
  {
        int s= read_sale_size();
        int s1= read_data_size();

        
         string name,batch,cost,price,expiry,sales;
         string quantity;

         int f_quantity; // store the final value of quantity
         int f_sales;//store the final value of quantity
    
    
    string sname,sbuyer,sdate; // sales information
    int squantity;

    double iquantity; // store intger value quantity
    double isales; // store intger value of sales
    double isquantity;
   
      ofstream output;
      output.open("sales.csv",std::ios::app);
      
          cout <<  "enter the name of the drug" << endl;
                cin >> sname;
                check_name(sname);
                
          output << sname<< ",";

           cout << "enter the amount sold" << endl;
           cin >> squantity;
         

          output << squantity<< ",";

           cout << "enter the name of the buyer" << endl;
           cin >> sbuyer;
          output << sbuyer<< ",";

            cout << "enter the date of the sale transaction" << endl;
            cin >> sdate;
          output << sdate<< "\n";
        

          cout << "sales record  successfully added" << endl;
       
       
      
          
          
          

      
      output.close();

      
    

      ifstream input;
      input.open("data2.csv");
      //ofstream output;
      output.open("new.csv");
      for(int i = 0 ; i < s1 ; i++)
      {
             getline(input,name,',');
      
          getline(input,batch,',');
          
       
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expiry,',');
          getline(input,sales,'\n');

          if(sname == name)
          {
              iquantity = stoi(quantity);
              isales = stoi(sales);
         
              f_quantity = iquantity - squantity;
               quantity = to_string(f_quantity);
             
              f_sales = isales +squantity;
              sales = to_string(f_sales);
             

          }
            
             output << name << ",";
            output << batch << ",";
            output << cost << ",";
            output << price<< ",";
            output << quantity << ",";
            output << expiry << ",";
            output << sales << "\n";

         

      }
    
    

      output.close();
      input.close();

       remove("data.csv");
  rename("new.csv","data.csv");

        output.open("size.csv");
      output << s1 << ",";
      output << s+1;
      output.close(); 
      
  

  }

  

  void change_admin() // change admin user name and password
  {
      admin_login();
      string user_name;
      string password;
      ofstream output;
      output.open("admin_u.csv");
      cout << "enter you new user name" << endl;
      cin >> user_name;
      output << user_name << ",";


      cout << "enter you new password" << endl;
      cin >> password;
      output << password<< "\n";

      cout << "your credentials have been successfully changed" << endl;



  }


    void change_user()  //change user's user name and password
  {
      user_login();
      string user_name;
      string password;
      ofstream output;
      output.open("user.csv");
      cout << "enter you new user name" << endl;
      cin >> user_name;
      output << user_name << ",";


      cout << "enter you new password" << endl;
      cin >> password;
      output << password<< "\n";

      cout << "your credentials have been successfully changed" << endl;



  }

  void expire_date()
  {
        int s= read_data_size();
        time_t t = time(NULL);                  // help us to access the current date month and yrear
      tm *tptr = localtime(&t);

           int c_day = (tptr ->tm_mday);  // current day
        int c_month =(tptr ->tm_mon) + 1; // current month
        int c_year = (tptr->tm_year) +1900; // current year
      
       string name,batch,cost,price,quantity,expire_date,expire_month,expire_year,sales;

       int i_expire_date;
       int i_expire_month;
       int i_expire_year;

       int yr;
       int mr;
       int dr;
        ifstream input;
        int count = 0;
        input.open("data.csv");

         for(int i = 0 ; i < s -1 ; i++)
         {
          count++;
          
          
          getline(input,name,',');
          getline(input,batch,',');
          getline(input,cost,',');
          getline(input,price,',');

          getline(input,quantity,',');
          getline(input,expire_date,'/');
           getline(input,expire_month,'/');
            getline(input,expire_year,',');
          getline(input,sales,'\n');

          if(count == 1)
          {
              cout << setw(10) << "name" << setw(70) << "time remaining untill expire date" << endl;
          }

          if(count > 1)
          {
             i_expire_date = stoi(expire_date);
              i_expire_month = stoi(expire_month);
              i_expire_year = stoi(expire_year);

       

             if(i_expire_date >= c_day)
             {
                 dr = i_expire_date - c_day;
             }

             else if(i_expire_date < c_day)
             {
                 dr = (i_expire_date+30) - c_day;
                 i_expire_month--;
             }


              if(i_expire_month >= c_month)
             {
                 mr = i_expire_month - c_month;
             }

             else if(i_expire_month < c_month)
             {
                 mr = (i_expire_month+12) - c_month;
                 i_expire_year--;
             }

              if(i_expire_year >= c_year)
             {
                 yr = i_expire_year - c_year;
             }

            else if(i_expire_year < c_year)
             {
               cout << setw(10) << name << setw(80) << "the drug has expired" << endl;
               continue;
             }

        


              cout << setw(10) << name << setw(50) << yr<<" year :" << mr<<" month :" <<dr<<" days";
              cout << " approximatly remaining" << endl;

              

         
              /*
              if(yr > 0)
              {
                   cout << setw(10) << name << setw(50) << "more than a year remaining" << endl;
                  
              }
              else if(yr == 0)
              {
                   cout << setw(10) << name << setw(30) << "a couple of months remaining" << endl;

              }
              else
              {
                   cout << setw(10) << name << setw(30) << "the drug has expired" << endl;
              }

              */
              
              

          }
          
          
     
     

          




  }


  input.close();


  }



  void admin_uI()
  {
      int choice;
      cout << "choose 1 task to be completed" << endl;
     

      do
      {      cout << "1.display all medicine available in the inventory with detail information" << endl;
      cout << "2.all medicine with low quantity" << endl;
      cout << "3.display all sale records" << endl;
      cout << "4.add sale record" << endl;
      cout << "5. record new drug information" << endl;
      cout << "6.delete a drug information" << endl;
      cout << "7.update drug information" << endl;
      cout << "8.search drug" << endl;
      cout << "9.expire date notification" << endl;
      cout << "10.total number of sales" << endl;
      cout << "11.total profit of the company" << endl;
      cout << "12.stastical report" << endl;
      cout << "13.change admin user name and password" << endl;
      cout << "14.change user's user name and password" << endl;
      cout << "15.quit" << endl;

           choice = int_input();
          switch(choice)
          {
              case 1:
              {
                  display_all();
                  system("pause");
                     system("cls");
                     break;

                  

              }
              case 2:
              {
                  low_quantity();
                  system("pause");
                  system("cls");
                  break;
              }

              case 3:
              {
                     display_sales();
                  system("pause");
                  system("cls");
                  break;

              }

              case 4:
              {
                    add_sale();
                  system("pause");
                  system("cls");
                  break;

              }

              case 5:
              {
                  insert();
                   system("pause");
                  system("cls");
                  break;
              }
              case 6:
              {
                  delete_drug();
                   system("pause");
                  system("cls");
                  break;

              }

              case 7:
              {
                  update();
                   system("pause");
                  system("cls");
                  break;

              }

              case 8:
              {
                      search();
                   system("pause");
                  system("cls");
                  break;

              }

              case 9:
              {
                   expire_date();
                   system("pause");
                  system("cls");
                  break;

              }

              case 10:
              {
                   total_sales();
                   system("pause");
                  system("cls");
                  break;

              }
              case 11:
              {
                   total_profit();
                   system("pause");
                  system("cls");
                  break;

              }

              case 12:
              {
                  stastical_report();
                   system("pause");
                  system("cls");
                  break;

              }
               case 13:
              {
                  change_admin();
                   system("pause");
                  system("cls");
                  break;

              }

               case 14:
              {
                  change_user();
                   system("pause");
                  system("cls");
                  break;

              }

              
              
              case 15:
              {
                  terminate();
              }

              

          }

      }
      while(choice != 12);
      
      
      

      
      
  }

  void user_uI()
  {
      
      int choice;
      cout << "choose 1 task to be completed" << endl;
     

      do
      {
      cout << "1.display all medicine available in the inventory with detail information" << endl;
      cout << "2.all medicine with low quantity" << endl;
      cout << "3.add sale records" << endl;
      cout << "4. record new drug information" << endl;
      cout << "5.update drug information" << endl;
      cout << "6.search drug" << endl;
      cout << "7.expire date notification" << endl;
      cout << "8.quit" << endl;
           choice = int_input();
          
          switch(choice)
          {
              case 1:
              {
                  display_all();
                   system("pause");
                  
                   system("cls");
                      break;
                  

                  
                 


                  

              }
              case 2:
              {
                  low_quantity();
                
                    
                     system("pause");
                   system("cls");
                      break;

                  
                  
                 
              }

          

              case 3:
              {
                  add_sale();
                 
                   system("pause");
                     
                   system("cls");
                      break;

              }
              case 4:
              {
                  insert();
                 
                  
                system("pause");
            
                system("cls");
                 break;
              }
       
              case 5:
              {
                  update();
                 
                    system("pause");
                   system("cls");
                    break;
              }
              case 6:
              {
                  search();
               
                system("pause");

                   system("cls");
                      break;
              }
              case 7:
              {
                  expire_date();

                  system("pause");
                   system("cls");
                   break;

              }
              case 8:
              {
                  exit(5);
                  
                  
                     }

      }

      }
      while(choice != 8);
  }
  
  


    
   
int main()
{
    system("color 90");
    
    
    cout << "welcome to bahran pharmacetucal app" << endl;
    cout << "please choose your user" << endl;
    int choice;
   
    do
    {
       
     cout << "1.Admin" << endl;
    cout << "2.user" << endl;
    cout << "3.quit" << endl;
     choice = int_input();
    
    

          switch(choice)
    {
        case 1:
        {
            
            admin_login();
            admin_uI();
            
            
            break;
        }
        case 2:
        {
            user_login();
            user_uI();
            
    
            break;
        }
        case 3:
        {
            return 0;
        }
        default:
        cout << "please either choose 1 or 2" << endl;
        
        break;
    }

    }
    while(choice != 3);
  

}