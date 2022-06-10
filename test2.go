package main

import (
	"encoding/json"
	"fmt"

		"io/ioutil"
		"net/http"
	"time"
	"database/sql"

	_ "github.com/go-sql-driver/mysql"

)


type Exoplanet struct {
	PlName          string  `json:"pl_name"`
	SyDist          float64 `json:"sy_dist"`
	DiscYear        int     `json:"disc_year"`
	Discoverymethod string  `json:"discoverymethod"`
	DiscTelescope   string  `json:"disc_telescope"`
	PlOrbper        float64 `json:"pl_orbper"`
	PlRadj          float64 `json:"pl_radj"`
	PlMasse         float64 `json:"pl_masse"`
	PlOrbeccen      float64 `json:"pl_orbeccen"`
	Moons 					int			`json:"sy_mnum"`
	PlRade					float64	`json:"pl_rade"`
	PlMassj					float64	`json:"pl_massj"`
	Density					float64 `json:"pl_dens"`
	DiscFac					string	`json:"disc_facility"`
}

// PrettyPrint to print struct in a readable way
func PrettyPrint(i interface{}) string {
	s, _ := json.MarshalIndent(i, "", "\t")
	return string(s)
}



func main(){

	fmt.Println("Drivers:", sql.Drivers())
	var err error
	db, err := sql.Open("mysql", "fsanche3:isc496@/fsanche3_22S")
	if err != nil {
		panic(err.Error())
	}

	 //this line confims connection
	if err := db.Ping(); err != nil {
		panic(err.Error())
	}

	//resp, err := http.Get("https://exoplanetarchive.ipac.caltech.edu/TAP/sync?query=select+pl_name,sy_dist,disc_year,discoverymethod,disc_telescope,pl_orbper,pl_radj,pl_masse,pl_orbeccen,sy_mnum,pl_rade,pl_massj,pl_dens,disc_facility+from+ps&format=json")
	resp, err := http.Get("https://exoplanetarchive.ipac.caltech.edu/TAP/sync?query=select+pl_name,sy_dist,disc_year,discoverymethod,disc_telescope,pl_orbper,pl_radj,pl_masse,pl_orbeccen,sy_mnum,pl_rade,pl_massj,pl_dens,disc_facility+from+ps&format=json")

	if err != nil {
		fmt.Println("No response from request")
	}

	fmt.Printf("RESP: %v\n", resp)

	defer resp.Body.Close()
	body, err := ioutil.ReadAll(resp.Body) // response body is []byte

	// when working with slice per byte[]
	result := []Exoplanet{}

	//[]byte(body) // Parse []byte to the go struct pointer
	err = json.Unmarshal(body, &result)
	if err != nil {
		fmt.Println("Can not unmarshal JSON: ", err)
	}

		 // General "exoplanets" table insertion
	  prep, es := db.Prepare("INSERT INTO exo (PlanetName, SyDist, DiscYear, DiscMeth, DiscTel, PlOrb, PlRadj, PlMasse, PlOrbeccen, Moons, PlRade, PlMassj, Density, DiscFac) VALUES (?, ?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?, ?)")
	   if es != nil{
	   	panic(es.Error())
	   }
		 //
	    for i, _ := range result{
	    _ , err := prep.Exec(result[i].PlName, result[i].SyDist, result[i].DiscYear, result[i].Discoverymethod, result[i].DiscTelescope,result[i].PlOrbper, result[i].PlRadj, result[i].PlMasse, result[i].PlOrbeccen, result[i].Moons,result[i].PlRade, result[i].PlMassj, result[i].Density, result[i].DiscFac)
	    if err != nil {
	    	panic(err.Error())
	    }
	  }
	time.Sleep(time.Second * 150)

	defer db.Close()
	fmt.Println("Succesfully Connected to Db")
}
