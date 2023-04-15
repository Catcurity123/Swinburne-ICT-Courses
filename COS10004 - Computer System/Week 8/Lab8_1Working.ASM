
BASE=$3F000000
GPIO_OFFSET=$200000
mov     r0,BASE 
orr     r0,GPIO_OFFSET

;start of GPIO
mov r1,#1
lsl r1,#24
str r1,[r0,#4]     ;set GPIO18 GRN to output

loop$:             ;outer loop - repeat LED on, wait, LED off, wait
  mov r1,#1
  lsl r1,#18
  str r1,[r0,#28]  ;turn LED on

   mov r2,$10000
   orr r2,$9500
   orr r2,$A
   mov r2,r3

  wait1$:
    sub r3,$5000
    cmp r3,$0
    bne wait1$    ;count from  983040 to 0 (busy wait)

  str r1,[r0,#40]   ;turn LED off (writing to the pull up register)

  mov r2,$10000
  orr r2,$9500
  orr r2,$A
  mov r2,r3

  wait2$:
    sub r3,$5000
    cmp r3,$0
    bne wait2$    ;count from 983040 to 0 (busy wait)
b loop$  ;end of outer loop