package main

import (
	"database/sql"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

func main() {
	fmt.Println("Drivers:", sql.Drivers())
	var err error
	db, err := sql.Open("mysql", "fsanche3:isc496@/fsanche3_22S")

	if err != nil {
		panic(err.Error())
	}

	// this line confims connection
	if err := db.Ping(); err != nil {
		panic(err.Error())
	}
	defer db.Close()
	fmt.Println("Succesfully")

}
