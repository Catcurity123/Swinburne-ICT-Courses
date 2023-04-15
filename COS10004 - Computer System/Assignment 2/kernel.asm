format binary as 'img'
BASE=$3F000000    ; RPI 4 Peripherals address ;
;BASE=$3F000000 for RP2 and RP3 Peripherals address

mov sp,$1000  ;make room on the stack

bl INIT  ;  calls init function with register and array initialisations

; Start-up flash sequence - 7 short flashes
mov r0,BASE
mov r1,7;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

; Stage 1a start - 1 short short flash
mov r0,BASE
mov r1,1;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 1A function call
mov r0,r5
mov r1,r6
mov r2,r7
bl stage1a_min
mov r9,r0 ; mov result to r9

; Flash the answer for Stage 1A
mov r2,$80000  ; pass flash timer delay
mov r1, r9  ; pass number to flash
mov r0, BASE  ; pass BASE address for peripherals
bl FLASH
mov r1,$200000  ; 2 seconds delay
bl PAUSE  ; Pause for 2 seconds


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 1B function call
mov r0,r5
mov r1,r6
mov r2,r7
bl stage1b_max
mov r9,r0 ; mov result to r9

; Flash the answer for Stage 1B
mov r2,$80000  ; pass flash timer delay
mov r1, r0  ; pass number to flash
mov r0, BASE  ; pass BASE address for peripherals
bl FLASH
mov r1,$200000  ; 2 seconds delay
bl PAUSE ; Pause for 2 seconds

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 1C function call
mov r0,r5
mov r1,r6
mov r2,r7
bl stage1c_diff
mov r9,r0 ; mov result to r9

; Flash the answer for Stage 1c
mov r2,$80000  ; pass flash timer delay
mov r1, r9  ; pass number to flash
mov r0, BASE  ; pass BASE address for peripherals
bl FLASH
mov r1,$200000  ; 2 seconds delay
bl PAUSE ; Pause for 2 seconds

; Stage 2 start - 2 short short flashes
mov r0, BASE
mov r1,2;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 2 function call  (flash the contents of numarray1)
mov r0,BASE ; pass peripheral base address
mov r1,r8  ; size of arrays
adr r2,numarray1
bl stage2_flash_array

mov r1, $200000
mov r0, BASE
bl PAUSE   ; Pause for 2 seconds



;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 3 function call (bubble sort numarray1 and flash contents

; Stage 3 start - 3 short flashes
mov r0,BASE
mov r1,3;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

mov r0,r8   ; size of array
adr r1,numarray1 ; address of input array
mov r2, BASE  ; pass BASE address of peripherals
bl stage3_bubblesort


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
; Stage 4 function call (quicksort numarray2 and flash contents

; Stage 4 start - 4 short flashes
mov r0,BASE
mov r1,4;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

mov r0,8   ; size of array
adr r1,numarray2 ; address of input array
mov r2,BASE   ; pass BASE address of peripherals
bl stage4_quicksort

; Completion flash sequence - 7 short flashes
mov r0,BASE
mov r1,7;
mov r2,$20000  ; pause time between flashes r10
bl FLASH
mov r1,$200000 ; pause time
bl PAUSE

finalloop$:
b finalloop$

include "INIT.asm"
include "FLASH.asm"
include "PAUSE.asm"
include "stage1a_min.asm"
include "stage1b_max.asm"
include "stage1c_diff.asm"
include "stage2_flash_array.asm"
include "stage3_bubblesort.asm"
include "stage4_quicksort.asm"


