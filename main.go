package main

import (
	"database/sql"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"log"
	"net/http"
	"strconv"
	"time"
)

type Vehicle struct {
	Vid       string `json:"vid"`
	TmStmp    string `json:"tmstmp"`
	Lat       string `json:"lat"`
	Lon       string `json:"lon"`
	Hdg       string `json:"hdg"`
	Pid       int    `json:"pid"`
	Rt        string `json:"rt"`
	Des       string `json:"des"`
	PDist     int    `json:"pdist"`
	Dly       bool   `json:"dly"`
	Spd       int    `json:"spd"`
	Tatripid  string `json:"tatripid"`
	TabLockId string `json:"tablockid"`
	Zone      string `json:"zone"`
}

type VehicleResponse struct {
	VehicleArray []Vehicle `json:"vehicle"`
}

type GetVehiclesResponse struct {
	BustimeResponse VehicleResponse `json:"bustime-response"`
}

type Prediction struct {
	Tmstmp    string `json:"tmstmp"`
	Typ       string `json:"typ"`
	Stpnm     string `json:"stpnm"`
	Stpid     string `json:"stpid"`
	Vid       string `json:"vid"`
	Dstp      int    `json:"dstp"`
	Rt        string `json:"rt"`
	Rtdd      string `json:"rtdd"`
	Rtdir     string `json:"rtdir"`
	Des       string `json:"des"`
	Prdtm     string `json:"prdtm"`
	Tablockid string `json:"tablockid"`
	Tatripid  string `json:"tatripid"`
	Dly       bool   `json:"dly"`
	Dyn       int    `json:"dyn"`
	Prdctdn   string `json:"prdctdn"`
	Zone      string `json:"zone"`
}

type PredictionResponse struct {
	PrdArray []Prediction `json:"prd"`
}

type GetPredictionsResponse struct {
	BustimeResponse PredictionResponse `json:"bustime-response"`
}

type Tag struct {
	ID  int    `json:"id"`
	Tag string `json:"tag"`
}

var db *sql.DB // Database reference

func main() {
	fmt.Println("Starting...")

	// Main Polling Loop
	for {
		// Open the database connection.
		var err error
		// Change the user id and password below
		db, err = sql.Open("mysql", "<user_id>:<password>@tcp(pi.cs.oswego.edu:3306)/Centro")

		fmt.Println("JPE--db,err:", db, err)

		// if there is an error opening the connection, handle it
		if err != nil {
			panic(err.Error())
		}

		// Get the API response from Centro
		vehicleResponse := getVehicle("OSW09,OSW10,OSW11")

		fmt.Println("JPE--length:", len(vehicleResponse.VehicleArray))
		for i, vehicle := range vehicleResponse.VehicleArray {
			// Iterate through each vehicle entry
			fmt.Println("JPE--1,vehicle:", i, vehicle)

			// Insert this vehicle data into the mySQL vehicles table
			result, err := db.Query("INSERT INTO vehicles (vid,tmstmp,lat,lon,hdg,pid,rt,des,pdist,dly,spd,tatripid,tablockid,zone) " +
				"VALUES ('" +
				vehicle.Vid + "','" +
				vehicle.TmStmp + "'," +
				vehicle.Lat + "," +
				vehicle.Lon + ",'" +
				vehicle.Hdg + "'," +
				strconv.Itoa(vehicle.Pid) + ",'" +
				vehicle.Rt + "','" +
				vehicle.Des + "'," +
				strconv.Itoa(vehicle.PDist) + "," +
				strconv.FormatBool(vehicle.Dly) + "," +
				strconv.Itoa(vehicle.Spd) + ",'" +
				vehicle.Tatripid + "','" +
				vehicle.TabLockId + "','" +
				vehicle.Zone + "')")

			fmt.Println("JPE-insert vehicle result, err", result, err)

			// Check for an insertion error
			if result != nil {
				// Close the result table
				result.Close()

			}

			// Get the stop predictions for this vehicle id
			pR := getPrediction(vehicle.Vid)
			for j, prediction := range pR.PrdArray {
				fmt.Printf("Prediction %d: %+v\n", j, prediction)

				// Insert each prediction into the table
				result, err := db.Query("INSERT INTO predictions (tmstmp,typ,stpnm,stpid,vid,dstp,rt,rtdd,rtdir,des,prdtm,tablockid,tatripid,dly,dyn,prdctdn,zone) " +
					"VALUES ('" +
					prediction.Tmstmp + "','" +
					prediction.Typ + "','" +
					prediction.Stpnm + "','" +
					prediction.Stpid + "','" +
					prediction.Vid + "'," +
					strconv.Itoa(prediction.Dstp) + ",'" +
					prediction.Rt + "','" +
					prediction.Rtdd + "','" +
					prediction.Rtdir + "','" +
					prediction.Des + "','" +
					prediction.Prdtm + "','" +
					prediction.Tablockid + "','" +
					prediction.Tatripid + "'," +
					strconv.FormatBool(prediction.Dly) + "," +
					strconv.Itoa(prediction.Dyn) + ",'" +
					prediction.Prdctdn + "','" +
					prediction.Zone + "')")

				fmt.Println("JPE-insert prediction result, err", result, err)

				// Check for an insertion error
				if result != nil {
					// Close the result table
					result.Close()

				}

			}
		}

		// Close the database connection until the next cycle. This
		// elimatinates the "too many connections" error
		db.Close()

		// Wait 15 seconds, then issue another query
		time.Sleep(time.Second * 15)
	}

}

func getVehicle(rt string) *VehicleResponse {
	// This function issues a vehicles API call and returns a related object
	// API key for all requests
	apiKey := "PUZXP7CxWkPaWnvDWdacgiS4M"

	resp, err := http.Get("http://bus-time.centro.org/bustime/api/v3/getvehicles?key=" +
		apiKey +
		"&rt=" + rt +
		"&format=json" +
		"&tmres=s")
	if err != nil {
		log.Fatalln(err)
	}

	//fmt.Println("JPE--resp:", resp)

	defer resp.Body.Close()

	body, err := ioutil.ReadAll(resp.Body)
	//fmt.Println("JPE--body", string(body))
	var responseObj GetVehiclesResponse
	err = json.Unmarshal(body, &responseObj)
	if err != nil {
		fmt.Println("Vehicle error:", err)
	}
	//fmt.Println("---=== Response ===---")
	//fmt.Printf("%+v", responseObj)

	return &responseObj.BustimeResponse
}

// getPrediction issues an API call to get the arrival time prediction
// of the named vehicle id
func getPrediction(vid string) *PredictionResponse {
	fmt.Println("JPE--getPrediction vid:", vid)
	apiKey := "PUZXP7CxWkPaWnvDWdacgiS4M"

	resp, err := http.Get("http://bus-time.centro.org/bustime/api/v3/getpredictions?key=" +
		apiKey +
		"&vid=" + vid +
		"&format=json" +
		"&tmres=s")
	if err != nil {
		log.Fatalln(err)
	}

	fmt.Println("JPE--prediction resp code:", resp)

	defer resp.Body.Close()

	body, err := ioutil.ReadAll(resp.Body)
	//fmt.Println("JPE-- prediction body", string(body))
	var responseObj GetPredictionsResponse
	err = json.Unmarshal(body, &responseObj)
	if err != nil {
		fmt.Println("error:", err)
	}
	//fmt.Println("---=== Predictions Response ===---")
	//fmt.Printf("%+v", responseObj.BustimeRespons)

	return &responseObj.BustimeResponse

}
