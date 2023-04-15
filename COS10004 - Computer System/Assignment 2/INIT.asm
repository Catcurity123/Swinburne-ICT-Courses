; function INIT
; initialises registers and array for testing
 ; - assigns registers r5, r6, and r7 with values for Stage 1 and 2
 ; - defines the array "numarray1" for Stage 2 and 3 and initaises it
 ; - defines the array "numarray2" for Stage 4 and initilises it
 ; - assign the length of both arrays (the same size) to r8

; NOTE: the values assigned to registers and in arrays may  be changed for testing
; different inputs, but DO NOT change the registers being assigned, or the names of
; any labels.  Suggest keeping assigned values at 5 or lower to avoid long flashing
; sequences

INIT:
        ; initialises input values for Stages 1A, 1B and 1C
        ; you can change the values but not the registers
        mov r5, #1   ; arg 1 for Stage 1
        mov r6, #3   ; arg 2 for Stage 1
        mov r7, #4   ; arg 3 for Stage 1


        ; initialises arrays for Stages 3, 4 and 5
        ; you can change the values in the arrays, but not the array names

        ; numarray1 for Stage 2 and 3
        ; numarray holds 32 bit (dw) values
        align 2    ; this should not need changing
        numarray1:
                dw  5, 1, 4, 2, 3, 3, 4, 1     ; you can change the values here


        ; numarray2  for Stage 4
        ; numarray2 holds 32 bit (dw) values

        align 2    ; this should not need changing
        numarray2:
                dw 5, 1, 4, 2, 3, 7, 6, 8    ; you can change the values here


        mov r8, 8  ; size of both arrays defined above
        bx lr