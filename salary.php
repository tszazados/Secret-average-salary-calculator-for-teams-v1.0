<?php

/**
 * This tiny program is for PHP CLI only.
 *
 * Developed for calculating the average of the entered numbers without 
 * keeping the concrete values in the memory or even on the screen.
 * 
 * Can be useful to calculate a team members' average salary
 * without letting know each other's. The minimum number of
 * participants is 3 otherwise no calculation will be made.
 * 
 * @author szazadost
 * @date   2018.08.17
 *
 */

// Sending these chars to STDOUT clears the line.. if NOT, warning message appears
define ( "CLNR_CODE", "\r\033[K\033[1A\r\033[K\r" ) ;

print "\033[32m \n\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n" ;
print "\033[0m AVERAGE SALLARY CALCULATOR V1.0\n\n" ;
print "This application is not going to show the entered values, only the average of them.\n" ;
print "If less than three numbers are entered the application will NOT calculate and abort.\n" ;
print "type \"exit\" or \"x\" to finish.\n\n" ;
print "*****************************************************" . CLNR_CODE ; 
print "  WARNING! IF YOU SEE THIS, THIS PROGRAM IS NOT SAFE " . CLNR_CODE ;
print "  TO USE AND CAN NOT HIDE THE ENTERED VALUES !!!!!!! " . CLNR_CODE ;
print "*****************************************************" . CLNR_CODE ;

//INITIALIZE VARIABLES...
$normalizedSum = $inputCounter = 0 ;

//STARTING THE LOOP FOR PROMPTING NUMERIC VALUES OR "exit" STRING...
while ( 1 === 1 && ( php_sapi_name ( ) === "cli" || defined ( "STDIN" ) ) )
{
    print "Enter your net(to) salary:  \033[33m " . ( $inputCounter===0 ? "( for example: \"100000\" if yours is 100.000 HUF )\033[0m \n" : "\n" ) ;
    print "\033[36m ({$inputCounter})> \033[0m " ;

    $inputStr = PHP_OS == "WINNT" ? stream_get_line(STDIN, 1024, PHP_EOL) : readline ("") ;
    
    // EXIT CASE, BREAKING THE LOOP IF "exit" GIVEN
    if ( in_array ( strtoupper ( $inputStr ),  [ "EXIT", "Q", "X", "BYE", "QUIT" ] ) === TRUE ) 
    {
        if ( $inputCounter < 3 )
        {
            die ( "\n" . "ERROR: Not enough values. The minimum required is 3...". "\n" ) ;              // aborting to shell..
        }
        else
        {
            die ( "\n" . "OK. The average salary for {$inputCounter} workers is $normalizedSum.") ;   // aborting to shell..
        }
    }
    
    print CLNR_CODE;              // sending all type of console characters to put the cursor back and to clear the entered input...
    
    // CALCULATING THE AVERAGE VALUE AND GOING BACK TO GET THE NEXT VALUE FROM STDIN.. IF VALID INTEGER GIVEN
    if ( ctype_digit ( $inputStr ) === true )       // entering here if contains only 0..9 characters 
    {
        // calculating the average value and not storing the entered one :
        // new average value = ( previous average * (people count -1)  + new value ) / people count
        $normalizedSum = round ( $normalizedSum * $inputCounter++ + $inputStr ) / $inputCounter ;
    }
    else
    {
        
        print "\033[31m ???????Invalid integer value.\033[0m \n" ;
        
    }
    
}

die("This program can run in only from Command Line (CLI). Aborting. ") ;
