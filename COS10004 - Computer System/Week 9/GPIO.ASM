
SETUP_LED:
 GPIO_OFFSET = $200000
 orr r0,GPIO_OFFSET

 mov r1,#1
 lsl r1,#24
 str r1,[r0,#4]     ;set GPIO18 to output
bx lr




FLASH: ;Para = r1 = 24, r0 = 3F000000
BASE = $3F000000
GPIO_OFFSET = $200000
orr r0,GPIO_OFFSET

mov r7,r1
loop$:
  ;Turn GPIO18 on
  mov r1,#1
  lsl r1,#18
  str r1,[r0,#28]

  push{r0, r1, r7, lr}
  mov r0,BASE
  mov r11,$7A000
  orr r11,$120
  mov r1,r11 ;7A120
  bl Delay
  pop{r0, r1, r7, lr}

  ;Turn GPIO18 off
  mov r1,#1
  lsl r1,#18
  str r1,[r0,#40]

  push{r0, r1, r7, lr}
  mov r0,BASE
  mov r11,$7A000
  orr r11,$120
  mov r1,r11 ;7A120
  bl Delay
  pop{r0, r1, r7, lr}

  sub r7,#1
  cmp r7,#0
  bne loop$

bx lr