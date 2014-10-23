
function fillcountry(){ 
 // this function is used to fill the country list on load
addOption(document.drop_list.country, "India", "India", "");
addOption(document.drop_list.country, "Australia", "Australia", "");
addOption(document.drop_list.country, "America", "America", "");}

function Selectstate(){
// ON selection of country this function will work

removeAllOptions(document.drop_list.state);

if(document.drop_list.country.value == 'India'){
addOption(document.drop_list.state,"Andra Pradesh", "Andra Pradesh");
addOption(document.drop_list.state,"Assam", "Assam");
addOption(document.drop_list.state,"Arunachal Pradesh", "Arunachal Pradesh");
addOption(document.drop_list.state,"Ahmedabad", "Ahmedabad");
addOption(document.drop_list.state,"Bihar", "Bihar");
addOption(document.drop_list.state,"Chhattisgarh", "Chhattisgarh");
addOption(document.drop_list.state,"Goa", "Goa");
addOption(document.drop_list.state,"Gujarat", "Gujarat");
addOption(document.drop_list.state,"Haryana", "Haryana");
addOption(document.drop_list.state,"Himachal Pradesh", "Himachal Pradesh");
addOption(document.drop_list.state,"Jammu and Kashmir", "Jammu and Kashmir");
addOption(document.drop_list.state,"Jharkhand", "Jharkhand");
addOption(document.drop_list.state,"Karnataka", "Karnataka");
addOption(document.drop_list.state,"Kerala", "Kerala");
addOption(document.drop_list.state,"Madya Pradesh", "Madya Pradesh");
addOption(document.drop_list.state,"Maharashtra", "Maharashtra");
addOption(document.drop_list.state,"Manipur", "Manipur");
addOption(document.drop_list.state,"Meghalaya", "Meghalaya");
addOption(document.drop_list.state,"Mizoram", "Mizoram");
addOption(document.drop_list.state,"Nagaland", "Nagaland");
addOption(document.drop_list.state,"Orissa", "Orissa");
addOption(document.drop_list.state,"Punjab", "Punjab");
addOption(document.drop_list.state,"Rajasthan", "Rajasthan");
addOption(document.drop_list.state,"Sikkim", "Sikkim");
addOption(document.drop_list.state,"Tamil Nadu", "Tamil Nadu");
addOption(document.drop_list.state,"Tripura", "Sikkim");
addOption(document.drop_list.state,"Uttaranchal", "Tamil Nadu");
addOption(document.drop_list.state,"Uttar Pradesh", "Uttar Pradesh");
addOption(document.drop_list.state,"West Bengal", "West Bengal");

}
if(document.drop_list.country.value == 'Australia'){
addOption(document.drop_list.state,"Australian Capital Territory", "Australian Capital Territory");
addOption(document.drop_list.state,"New South Wales", "New South Wales");
addOption(document.drop_list.state,"Northern Territory", "Northern Territory", "");
addOption(document.drop_list.state,"Queensland", "Queensland");
addOption(document.drop_list.state,"South Australia", "South Australia");
addOption(document.drop_list.state,"Victoria", "Victoria", "");
addOption(document.drop_list.state,"Western Australia", "Western Australia");

}
if(document.drop_list.country.value == 'America'){
	
   
addOption(document.drop_list.state,"Alabama", "Alabama");   
addOption(document.drop_list.state,"Alaska", "Alaska"); 
 addOption(document.drop_list.state,"Arizona", "Arizona");  
addOption(document.drop_list.state,"Arkansas", "Arkansas");  
 addOption(document.drop_list.state,"Colorado", "Colorado"); 
addOption(document.drop_list.state,"Colorado", "Colorado");  
addOption(document.drop_list.state,"Connecticut", "Connecticut");    
addOption(document.drop_list.state,"Delaware", "Delaware");    
addOption(document.drop_list.state,"Florida", "Florida");    
addOption(document.drop_list.state,"Georgia", "Georgia");    
addOption(document.drop_list.state,"Idaho", "Idaho");   	
addOption(document.drop_list.state,"Illinois", "Illinois");   
addOption(document.drop_list.state,"Indiana", "Indiana");  
addOption(document.drop_list.state,"Iowa", "Iowa");  
addOption(document.drop_list.state,"Kansas", "Kansas");  
addOption(document.drop_list.state,"Kentucky", "Kentucky");  
addOption(document.drop_list.state,"Louisiana", "Louisiana");  
 addOption(document.drop_list.state,"Maine", "Maine"); 
addOption(document.drop_list.state,"Maryland", "Maryland"); 
addOption(document.drop_list.state,"Massachusetts", "Massachusetts"); 
addOption(document.drop_list.state,"Michigan", "Michigan");  	 
addOption(document.drop_list.state,"Minnesota", "Minnesota");  
addOption(document.drop_list.state,"Mississippi", "Mississippi");  
addOption(document.drop_list.state,"Missouri", "Missouri"); 
addOption(document.drop_list.state,"Montana", "Montana");  
addOption(document.drop_list.state,"Nebraska", "Nebraska");  
addOption(document.drop_list.state,"Nevada", "Nevada");  
addOption(document.drop_list.state,"New Hampshire", "New Hampshire");  
addOption(document.drop_list.state,"New Jersey", "New Jersey");  
addOption(document.drop_list.state,"New Mexico", "New Mexico");  
addOption(document.drop_list.state,"New York", "New York");  
 addOption(document.drop_list.state,"North Carolina", "North Carolina"); 	
addOption(document.drop_list.state,"North Dakota", "North Dakota");  
 addOption(document.drop_list.state,"Ohio", "Ohio"); 
addOption(document.drop_list.state,"Oklahoma", "Oklahoma");  
addOption(document.drop_list.state,"Oregon", "Oregon");  
addOption(document.drop_list.state,"Pennsylvania", "Pennsylvania"); 
addOption(document.drop_list.state,"Rhode Island", "Rhode Island"); 
 addOption(document.drop_list.state,"South Carolina", "South Carolina");  
 addOption(document.drop_list.state,"South Dakota", "South Dakota");  
 addOption(document.drop_list.state,"Tennessee", "Tennessee"); 
addOption(document.drop_list.state,"Texas", "Texas"); 
addOption(document.drop_list.state,"Utah", "Utah");
addOption(document.drop_list.state,"Vermont", "Vermont");
addOption(document.drop_list.state,"Virginia", "Virginia", "");
addOption(document.drop_list.state,"Washington", "Washington");
addOption(document.drop_list.state,"West Virginia", "West Virginia");
addOption(document.drop_list.state,"Wisconsin", "Wisconsin", "");
addOption(document.drop_list.state,"Wyoming", "Wyoming");

}
removeAllOptions(document.drop_list.city);

if(document.drop_list.country.value == 'India'){
addOption(document.drop_list.city,"Ahmedabad", "Ahmedabad");
addOption(document.drop_list.city,"Bengaluru/Bangalore", "Bengaluru/Bangalore");
addOption(document.drop_list.city,"Chandigarh", "Chandigarh");
addOption(document.drop_list.city,"Chennai", "Chennai");
addOption(document.drop_list.city,"Delhi", "Delhi");
addOption(document.drop_list.city,"Guntur", "Guntur");
addOption(document.drop_list.city,"Ongole", "Ongole");
addOption(document.drop_list.city,"Hyderabad/Secunderabad", "Hyderabad/Secunderabad");
addOption(document.drop_list.city,"Kolkatta", "Kolkatta");
addOption(document.drop_list.city,"Mumbai", "Mumbai");
addOption(document.drop_list.city,"Noida", "Noida");
addOption(document.drop_list.city,"Pune", "Pune");
addOption(document.drop_list.city,"Anantapur", "Anantapur");
addOption(document.drop_list.city,"Guntakal", "Guntakal");
addOption(document.drop_list.city,"kakinada", "kakinada");
addOption(document.drop_list.city,"kurnool", "kurnool");
addOption(document.drop_list.city,"Nellore", "Nellore");
addOption(document.drop_list.city,"Nizamabad", "Nizamabad");
addOption(document.drop_list.city,"Rajahmundry", "Rajahmundry");
addOption(document.drop_list.city,"Tirupati", "Tirupati");
addOption(document.drop_list.city,"Vijayawada", "Vijayawada");
addOption(document.drop_list.city,"Visakhapatnam", "Visakhapatnam");
addOption(document.drop_list.city,"Warangal", "Warangal");
addOption(document.drop_list.city,"Andra Pradesh-Other", "Andra Pradesh-Other");
addOption(document.drop_list.city,"Itanagar", "Itanagar");
addOption(document.drop_list.city,"Arunachal Pradesh-Other", "Arunachal Pradesh-Other");
addOption(document.drop_list.city,"Guwahati", "Guwahati");
addOption(document.drop_list.city,"Silchar", "Silchar");
addOption(document.drop_list.city,"Assam-Other", "Assam-Other");
addOption(document.drop_list.city,"Bhagalpur", "Bhagalpur");
addOption(document.drop_list.city,"Patna", "Patna");
addOption(document.drop_list.city,"Bihar-Other", "Bihar-Other");
addOption(document.drop_list.city,"Bhillai", "Bhillai");
addOption(document.drop_list.city,"Bilaspur", "Bilaspur");
addOption(document.drop_list.city,"Raipur", "Raipur");
addOption(document.drop_list.city,"Chhattisgarh-Other", "Chhattisgarh-Other");
addOption(document.drop_list.city,"Panjim/Panaji", "Panjim/Panaji");
addOption(document.drop_list.city,"Vasco Da Gama", "Vasco Da Gama");
addOption(document.drop_list.city,"Goa-Other", "Goa-Other");
addOption(document.drop_list.city,"Anand", "Anand");
addOption(document.drop_list.city,"Ankleshwar", "Ankleshwar");
addOption(document.drop_list.city,"Bhavnagar", "Bhavnagar");
addOption(document.drop_list.city,"Bhuj", "Bhuj");
addOption(document.drop_list.city,"Gandhinagar", "Gandhinagar");
addOption(document.drop_list.city,"Gir", "Gir");
addOption(document.drop_list.city,"Jamnagar", "Jamnagar");
addOption(document.drop_list.city,"Kandla", "Kandla");
addOption(document.drop_list.city,"Porbandar", "Porbandar");
addOption(document.drop_list.city,"Rajkot", "Rajkot");
addOption(document.drop_list.city,"Surat", "Surat");
addOption(document.drop_list.city,"Vadodara/Baroda", "Vadodara/Baroda");
addOption(document.drop_list.city,"Valsad", "Valsad");
addOption(document.drop_list.city,"Vapi", "Vapi");
addOption(document.drop_list.city,"Gujarat-Other", "Gujarat-Other");
addOption(document.drop_list.city,"Ambala", "Ambala");
addOption(document.drop_list.city,"Gurgaon", "Gurgaon");
addOption(document.drop_list.city,"Hisar", "Hisar");
addOption(document.drop_list.city,"Karnal", "Karnal");
addOption(document.drop_list.city,"Kurukshetra", "Kurukshetra");
addOption(document.drop_list.city,"Panipat", "Panipat");
addOption(document.drop_list.city,"Rohtak", "Rohtak");
addOption(document.drop_list.city,"Haryana-Other", "Haryana-Other");
addOption(document.drop_list.city,"Dalhousie", "Dalhousie");
addOption(document.drop_list.city,"Dharmasala", "Dharmasala");
addOption(document.drop_list.city,"Kulu/Manali", "Kulu/Manali");
addOption(document.drop_list.city,"Shimla", "Shimla");
addOption(document.drop_list.city,"Himachal Pradesh-Other", "Himachal Pradesh-Other");
addOption(document.drop_list.city,"Jammu", "Jammu");
addOption(document.drop_list.city,"Jammu and Kashmir-Other", "Jammu and Kashmir-Other");
addOption(document.drop_list.city,"Dhanbad", "Dhanbad");
addOption(document.drop_list.city,"Jamshedpur", "Jamshedpur");
addOption(document.drop_list.city,"Ranchi", "Ranchi");
addOption(document.drop_list.city,"Jharkhand-Other", "Jharkhand-Other");
addOption(document.drop_list.city,"Belgaum", "Belgaum");
addOption(document.drop_list.city,"Bellary", "Bellary");
addOption(document.drop_list.city,"Bidar", "Bidar");
addOption(document.drop_list.city,"Dharwad", "Dharwad");
addOption(document.drop_list.city,"Gulbarga", "Gulbarga");
addOption(document.drop_list.city,"Hubli", "Hubli");
addOption(document.drop_list.city,"Kolar", "Kolar");
addOption(document.drop_list.city,"Mangalore", "Mangalore");
addOption(document.drop_list.city,"Dalhousie", "Dalhousie");
addOption(document.drop_list.city,"Mysoru/Mysore", "Mysoru/Mysore");
addOption(document.drop_list.city,"Karnataka-Other", "Karnataka-Other");
addOption(document.drop_list.city,"Calicut", "Calicut");
addOption(document.drop_list.city,"Cochin", "Cochin");
addOption(document.drop_list.city,"Ernakulam", "Ernakulam");
addOption(document.drop_list.city,"Kannur", "Kannur");
addOption(document.drop_list.city,"Kochi", "Kochi");
addOption(document.drop_list.city,"Kollam", "Kollam");
addOption(document.drop_list.city,"Kottayam", "Kottayam");
addOption(document.drop_list.city,"Kozhikode", "Kozhikode");
addOption(document.drop_list.city,"Palakkad", "Palakkad");
addOption(document.drop_list.city,"Palghat", "Palghat");
addOption(document.drop_list.city,"Thrissur", "Thrissur");
addOption(document.drop_list.city,"Trivandrum", "Trivandrum");
addOption(document.drop_list.city,"Kerela-Other", "Kerela-Other");
addOption(document.drop_list.city,"Bhopal", "Bhopal");
addOption(document.drop_list.city,"Gwalior", "Gwalior");
addOption(document.drop_list.city,"Indore", "Indore");
addOption(document.drop_list.city,"Jabalpur", "Jabalpur");
addOption(document.drop_list.city,"Ujjain", "Ujjain");
addOption(document.drop_list.city,"Madhya Pradesh-Other", "Madhya Pradesh-Other");
addOption(document.drop_list.city,"Ahmednagar", "Ahmednagar");
addOption(document.drop_list.city,"Aurangabad", "Aurangabad");
addOption(document.drop_list.city,"Jalgaon", "Jalgaon");
addOption(document.drop_list.city,"Kolhapur", "Kolhapur");
addOption(document.drop_list.city,"Mumbai Suburbs", "Mumbai Suburbs");
addOption(document.drop_list.city,"Nagpur", "Nagpur");
addOption(document.drop_list.city,"Nasik", "Nasik");
addOption(document.drop_list.city,"Navi Mumbai", "Navi Mumbai");
addOption(document.drop_list.city,"Solapur", "Solapur");
addOption(document.drop_list.city,"Maharashtra-Other", "Maharashtra-Other");
addOption(document.drop_list.city,"Imphal", "Imphal");
addOption(document.drop_list.city,"Manipur-Other", "Manipur-Other");
addOption(document.drop_list.city,"Shillong", "Shillong");
addOption(document.drop_list.city,"Meghalaya-Other", "Meghalaya-Other");
addOption(document.drop_list.city,"Aizawal", "Aizawal");
addOption(document.drop_list.city,"Mizoram-Other", "Mizoram-Other");
addOption(document.drop_list.city,"Dimapur", "Dimapur");
addOption(document.drop_list.city,"Nagaland-Other", "Nagaland-Other");
addOption(document.drop_list.city,"Bhubaneshwar", "Bhubaneshwar");
addOption(document.drop_list.city,"Cuttak", "Cuttak");
addOption(document.drop_list.city,"Paradeep", "Paradeep");
addOption(document.drop_list.city,"Puri", "Puri");
addOption(document.drop_list.city,"Rourkela", "Rourkela");
addOption(document.drop_list.city,"Orissa-Other", "Orissa-Other");
addOption(document.drop_list.city,"Amritsar", "Amritsar");
addOption(document.drop_list.city,"Bathinda", "Bathinda");
addOption(document.drop_list.city,"Jalandhar", "Jalandhar");
addOption(document.drop_list.city,"Ludhiana", "Ludhiana");
addOption(document.drop_list.city,"Mohali", "Mohali");
addOption(document.drop_list.city,"Pathankot", "Pathankot");
addOption(document.drop_list.city,"Patiala", "Patiala");
addOption(document.drop_list.city,"Punjab-Other", "Punjab-Other");
addOption(document.drop_list.city,"Ajmer", "Ajmer");
addOption(document.drop_list.city,"Jaipur", "Jaipur");
addOption(document.drop_list.city,"Jodhpur", "Jodhpur");
addOption(document.drop_list.city,"Kota", "Kota");
addOption(document.drop_list.city,"Udaipur", "Udaipur");
addOption(document.drop_list.city,"Rajasthan-Other", "Rajasthan-Other");
addOption(document.drop_list.city,"Gangtok", "Gangtok");
addOption(document.drop_list.city,"Sikkim-Other", "Sikkim-Other");
addOption(document.drop_list.city,"Chennai", "Chennai");
addOption(document.drop_list.city,"Coimbatore", "Coimbatore");
addOption(document.drop_list.city,"Cuddalore", "Cuddalore");
addOption(document.drop_list.city,"Erode", "Erode");
addOption(document.drop_list.city,"Hosur", "Hosur");
addOption(document.drop_list.city,"Madurai", "Madurai");
addOption(document.drop_list.city,"Nagerkoil", "Nagerkoil");
addOption(document.drop_list.city,"Ooty", "Ooty");
addOption(document.drop_list.city,"Salem", "Salem");
addOption(document.drop_list.city,"Thanjavur", "Thanjavur");
addOption(document.drop_list.city,"Tirunalveli", "Tirunalveli");
addOption(document.drop_list.city,"Trichy", "Trichy");
addOption(document.drop_list.city,"Tuticorin", "Tuticorin");
addOption(document.drop_list.city,"Vellore", "Vellore");
addOption(document.drop_list.city,"Tamil Nadu-Other", "Tamil Nadu-Other");
addOption(document.drop_list.city,"Agartala", "Agartala");
addOption(document.drop_list.city,"Tripura-Other", "Tripura-Other");
addOption(document.drop_list.city,"Dadra & Nagar Haveli-Silvassa", "Dadra & Nagar Haveli-Silvassa");
addOption(document.drop_list.city,"Daman & Diu", "Daman & Diu");
addOption(document.drop_list.city,"Pondichery", "Pondichery");
addOption(document.drop_list.city,"Agra", "Agra");
addOption(document.drop_list.city,"Aligarh", "Aligarh");
addOption(document.drop_list.city,"Allahabad", "Allahabad");
addOption(document.drop_list.city,"Bareilly", "Bareilly");
addOption(document.drop_list.city,"Faizabad", "Faizabad");
addOption(document.drop_list.city,"Ghaziabad", "Ghaziabad");
addOption(document.drop_list.city,"Gorakhpur", "Gorakhpur");
addOption(document.drop_list.city,"Kanpur", "Kanpur");
addOption(document.drop_list.city,"Lucknow", "Lucknow");
addOption(document.drop_list.city,"Mathura", "Mathura");
addOption(document.drop_list.city,"Meerut", "Meerut");
addOption(document.drop_list.city,"Moradabad", "Moradabad");
addOption(document.drop_list.city,"Varanasi/Banaras", "Varanasi/Banaras");
addOption(document.drop_list.city,"Uttar Pradesh-Other", "Uttar Pradesh-Other");
addOption(document.drop_list.city,"Dehradun", "Dehradun");
addOption(document.drop_list.city,"Roorkee", "Roorkee");
addOption(document.drop_list.city,"Uttaranchal-Other", "Uttaranchal-Other");
addOption(document.drop_list.city,"Durgapur", "Durgapur");
addOption(document.drop_list.city,"Haldia", "Haldia");
addOption(document.drop_list.city,"Kharagpur", "Kharagpur");
addOption(document.drop_list.city,"Kolkatta", "Kolkatta");
addOption(document.drop_list.city,"Siliguri", "Siliguri");
addOption(document.drop_list.city,"West Bengal - Other", "West Bengal - Other");
}
if(document.drop_list.country.value == 'Australia'){
addOption(document.drop_list.city,"Sydney", "Sydney");
addOption(document.drop_list.city,"Melbourne", "Melbourne");
addOption(document.drop_list.city,"Brisbane", "Brisbane");
addOption(document.drop_list.city,"Perth", "Perth");
addOption(document.drop_list.city,"Adelaide", "Adelaide");
addOption(document.drop_list.city,"Gold Coast-Tweed", "Gold Coast-Tweed");
addOption(document.drop_list.city,"Newcastle", "Newcastle");
addOption(document.drop_list.city,"Canberra-Queanbeyan", "Canberra-Queanbeyan");
addOption(document.drop_list.city,"Canberra", "Canberra");
addOption(document.drop_list.city,"Wollongong", "Wollongong");
addOption(document.drop_list.city,"Sunshine Coast", "Sunshine Coast");
addOption(document.drop_list.city,"Greater Hobart", "Greater Hobart");
addOption(document.drop_list.city,"Geelong", "Geelong");
addOption(document.drop_list.city,"Townsville", "Townsville");
addOption(document.drop_list.city,"Cairns", "Cairns");
addOption(document.drop_list.city,"Darwin", "Darwin");
addOption(document.drop_list.city,"Toowoomba", "Toowoomba");
addOption(document.drop_list.city,"Launceston", "Launceston");
addOption(document.drop_list.city,"Albury-Wodonga", "Albury-Wodonga");
addOption(document.drop_list.city,"Ballarat", "Ballarat");
addOption(document.drop_list.city,"Bendigo", "Bendigo");
addOption(document.drop_list.city,"Mandurah", "Mandurah");
addOption(document.drop_list.city,"Burnie-Devonport", "Burnie-Devonport");
addOption(document.drop_list.city,"Mackay", "Mackay");
addOption(document.drop_list.city,"Latrobe Valley", "Latrobe Valley");
addOption(document.drop_list.city,"Rockhampton", "Rockhampton");
addOption(document.drop_list.city,"Bunbury", "Bunbury");
addOption(document.drop_list.city,"Bundaberg", "Bundaberg");
addOption(document.drop_list.city,"Hervey Bay", "Hervey Bay");
addOption(document.drop_list.city,"Wagga Wagga", "Wagga Wagga");
addOption(document.drop_list.city,"Coffs Harbour", "Coffs Harbour");
addOption(document.drop_list.city,"Gladstone", "Gladstone");
addOption(document.drop_list.city,"Shepparton", "Shepparton");
addOption(document.drop_list.city,"Mildura", "Mildura");
addOption(document.drop_list.city,"Tamworth", "Tamworth");
addOption(document.drop_list.city,"Port Macquarie", "Port Macquarie");
addOption(document.drop_list.city,"Orange", "Orange");
addOption(document.drop_list.city,"Dubbo", "Dubbo");
addOption(document.drop_list.city,"Geraldton", "Geraldton");
addOption(document.drop_list.city,"Dubbo", "Dubbo");
addOption(document.drop_list.city,"Nowra-Bomaderry", "Nowra-Bomaderry");
addOption(document.drop_list.city,"Bathurst", "Bathurst");
addOption(document.drop_list.city,"Warrnambool", "Warrnambool");
addOption(document.drop_list.city,"Kalgoorlie-Boulder", "Kalgoorlie-Boulder");
addOption(document.drop_list.city,"Lismore", "Lismore");
}

if(document.drop_list.country.value == 'America'){
addOption(document.drop_list.city,"New York", "New York");
addOption(document.drop_list.city,"Los Angeles", "Los Angeles");
addOption(document.drop_list.city,"Chicago", "Chicago");
addOption(document.drop_list.city,"Houston", "Houston");
addOption(document.drop_list.city,"Philadelphia", "Philadelphia");
addOption(document.drop_list.city,"Phoenix", "Phoenix");
addOption(document.drop_list.city,"San Antonio", "San Antonio");
addOption(document.drop_list.city,"San Diego", "San Diego");
addOption(document.drop_list.city,"Dallas", "Dallas");
addOption(document.drop_list.city,"San Jose", "San Jose");
addOption(document.drop_list.city,"Austin", "Austin");
addOption(document.drop_list.city,"Jacksonville", "Jacksonville");
addOption(document.drop_list.city,"Indianapolis", "Indianapolis");
addOption(document.drop_list.city,"San Francisco", "San Francisco");
addOption(document.drop_list.city,"Columbus", "Columbus");
addOption(document.drop_list.city,"Fort Worth", "Fort Worth");
addOption(document.drop_list.city,"Charlotte", "Charlotte");
addOption(document.drop_list.city,"Detroit", "Detroit");
addOption(document.drop_list.city,"El Paso", "El Paso");
addOption(document.drop_list.city,"Memphis", "Memphis");
addOption(document.drop_list.city,"Boston", "Boston");
addOption(document.drop_list.city,"Seattle", "Seattle");
addOption(document.drop_list.city,"Denver", "Denver");
addOption(document.drop_list.city,"Washington", "Washington");
addOption(document.drop_list.city,"Nashville", "Nashville");
addOption(document.drop_list.city,"Baltimore", "Baltimore");
addOption(document.drop_list.city,"Louisville", "Louisville");
addOption(document.drop_list.city,"Portland", "Portland");
addOption(document.drop_list.city,"Oklahoma City", "Oklahoma City");
addOption(document.drop_list.city,"Milwaukee", "Milwaukee");
addOption(document.drop_list.city,"Las Vegas", "Las Vegas");
addOption(document.drop_list.city,"Albuquerque", "Albuquerque");
addOption(document.drop_list.city,"Tucson", "Tucson");
addOption(document.drop_list.city,"Fresno", "Fresno");
addOption(document.drop_list.city,"Sacramento", "Sacramento");
addOption(document.drop_list.city,"Long Beach", "Long Beach");
addOption(document.drop_list.city,"Kansas City", "Kansas City");
addOption(document.drop_list.city,"Mesa", "Mesa");
addOption(document.drop_list.city,"Virginia Beach", "Virginia Beach");
addOption(document.drop_list.city,"Atlanta", "Atlanta");
addOption(document.drop_list.city,"Colorado Springs", "Colorado Springs");
addOption(document.drop_list.city,"Raleigh", "Raleigh");
addOption(document.drop_list.city,"Omaha", "Omaha");
addOption(document.drop_list.city,"Miami", "Miami");
addOption(document.drop_list.city,"Oakland", "Oakland");
addOption(document.drop_list.city,"Tulsa", "Tulsa");
addOption(document.drop_list.city,"Minneapolis", "Minneapolis");
addOption(document.drop_list.city,"Cleveland", "Cleveland");
addOption(document.drop_list.city,"Wichita", "Wichita");
addOption(document.drop_list.city,"Arlington", "Arlington");
addOption(document.drop_list.city,"New Orleans", "New Orleans");
addOption(document.drop_list.city,"Bakersfield", "Bakersfield");
addOption(document.drop_list.city,"Tampa", "Tampa");
addOption(document.drop_list.city,"Honolulu", "Honolulu");
addOption(document.drop_list.city,"Anaheim", "Anaheim");
addOption(document.drop_list.city,"Aurora", "Aurora");
addOption(document.drop_list.city,"Santa Ana", "Santa Ana");
addOption(document.drop_list.city,"St. Louis", "Riverside");
addOption(document.drop_list.city,"Corpus Christi", "Corpus Christi");
addOption(document.drop_list.city,"Pittsburgh", "Pittsburgh");

}
}

////////////////// 

function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
		selectbox.remove(i);
	}
}


function addOption(selectbox, value, text )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;

	selectbox.options.add(optn);
}
