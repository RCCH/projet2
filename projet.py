import csv,sqlite3
def base(nom_fichier,villebase) :
    f=open(nom_fichier,"r")
    
    fichier=csv.reader(f)
    conn = sqlite3.connect("test.db")
    
    requete1= "DROP TABLE " + villebase + " ;"
    requete2= "CREATE TABLE IF NOT EXISTS " + villebase + " (id INTEGER,  listing_url TEXT,  scrape_id INTEGER,  last_scraped TEXT,  name TEXT,  summary TEXT,  space TEXT,  description TEXT,  experiences_offered TEXT,  neighborhood_overview TEXT,  notes TEXT,  transit TEXT,  access TEXT,  interaction TEXT,  house_rules TEXT,  thumbnail_url TEXT,  medium_url TEXT,  picture_url TEXT,  xl_picture_url TEXT,  host_id INTEGER,  host_url TEXT,  host_name TEXT,  host_since TEXT,  host_location TEXT,  host_about TEXT,  host_response_time TEXT,  host_response_rate TEXT,  host_acceptance_rate TEXT,  host_is_superhost TEXT,  host_thumbnail_url TEXT,  host_picture_url TEXT,  host_neighbourhood TEXT,  host_listings_count INTEGER,  host_total_listings_count INTEGER,  host_verifications TEXT,  host_has_profile_pic TEXT,  host_identity_verified TEXT,  street TEXT,  neighbourhood TEXT,  neighbourhood_cleansed TEXT,  neighbourhood_group_cleansed TEXT,  city TEXT,  state TEXT,  zipcode INTEGER,  market TEXT,  smart_location TEXT,  country_code TEXT,  country TEXT,  latitude FLOAT,  longitude FLOAT,  is_location_exact TEXT,  property_type TEXT,  room_type TEXT,  accommodates INTEGER,  bathrooms FLOAT,  bedrooms INTEGER,  beds INTEGER,  bed_type TEXT,  amenities TEXT,  square_feet TEXT,  price FLOAT,  weekly_price FLOAT,  monthly_price FLOAT,  security_deposit TEXT,  cleaning_fee TEXT,  guests_included INTEGER,  extra_people TEXT,  minimum_nights INTEGER,  maximum_nights INTEGER,  calendar_updated TEXT,  has_availability TEXT,  availability_30 INTEGER,  availability_60 INTEGER,  availability_90 INTEGER,  availability_365 INTEGER,  calendar_last_scraped TEXT,  number_of_reviews INTEGER,  first_review TEXT,  last_review TEXT,  review_scores_rating INTEGER,  review_scores_accuracy INTEGER,  review_scores_cleanliness INTEGER,  review_scores_checkin INTEGER,  review_scores_communication INTEGER,  review_scores_location INTEGER,  review_scores_value INTEGER,  requires_license TEXT,  license TEXT,  jurisdiction_names TEXT,  instant_bookable TEXT,  cancellation_policy TEXT,  require_guest_profile_picture TEXT,  require_guest_phone_verification TEXT,  calculated_host_listings_count INTEGER,  reviews_per_month FLOAT);"
    #conn.execute(requete1)
    conn.execute(requete2)
    for row in fichier:
        #print(row) #lecture entière du fichier .csv
        for i in range(94) :
            #problème de la virgule, guillemets et dollards
            row[i] = row[i].replace(',' , '')
            row[i] = row[i].replace('"' , '')
            row[i] = row[i].replace('$' , '')
            
            #print (row[60]) #Essai de lecture des champs en question
        
        requete3 = 'INSERT INTO ' + villebase + ' VALUES("'
        for champ in row:
          requete3 += champ + '","'
        requete3 = requete3[:-2]
        requete3 += ')'
        #print(requete3)
        
        conn.execute(requete3) 
    conn.commit()
    conn.close()    
    f.close()

base("Paris.csv","Paris")


