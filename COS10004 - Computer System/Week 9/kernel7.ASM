format binary as 'img'
;Calculate
mov r1,#2 ;input
mov sp,$1000  ;make room on the stack
mov r0,r1

bl FACTORIAL
mov r7,r0 ;store answer

BASE = $3F000000 ;RP2 and RP3 ;GPIO_SETUP
mov r0,BASE
bl SETUP_LED

mov r0,BASE
mov r1, r7
bl FLASH

wait:
b wait

include "DELAY.asm"
include "factorialj.asm"
include "GPIO.asm"
