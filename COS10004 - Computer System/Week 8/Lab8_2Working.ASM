BASE = $3F000000
GPIO_OFFSET = $200000
TIMER_OFFSET = $3000
mov r0,BASE
orr r0,GPIO_OFFSET

;Enable output
mov r1,#1
lsl r1,#24
str r1,[r0,#4]

;Set up for turn LED
mov r1,#1
lsl r1,#18

loop$:

 mov r2,$3

 timerloop3:
 ;turn LED on
 str r1,[r0,#28]

 ;store base address of timer
 mov r3,BASE
 orr r3,TIMER_OFFSET

 ;store delay time x7A120 = 500.000
 mov r4,$70000
 orr r4,$0A100
 orr r4,$00020

 ;store current time to r6 and r7
 ldrd r6,r7,[r3,#4]

 ;move start time to r5
 mov r5,r6

 timerloop:
  ;Recheck current time
  ldrd r6,r7,[r3,#4]

  ;store elapsed time
  sub r8,r6,r5

  ;compare elapsed time to delay time and end loop if r8 = r4
  cmp  r8,r4
  bls timerloop

 ;turn off
 str r1,[r0,#40]

 ;the same as above
 ldrd r6,r7,[r3,#4]
 mov r5,r6

 timerloop2:
  ldrd r6,r7,[r3,#4]
  sub r8,r6,r5
  cmp  r8,r4
  bls timerloop2

 sub r2,$1
 cmp r2, $0
 bne timerloop3

 ;Turn LED off
 str r1,[r0,#40]

  ;Pause for 3 seconds
  mov r9, $2D0000
  orr r9, $C600
  orr r9, $C0

  ldrd r6,r7,[r3,#4]
  mov r5,r6

 timerloop4:
  ldrd r6,r7,[r3,#4]
  sub r8,r6,r5
  cmp  r8,r9
  bls timerloop4

b loop$


