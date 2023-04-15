FACTORIAL:
mul r0,r0,r1

sub r1,r1,#1
cmp r1,#1
beq EXIT

push {r1,lr} ;first time is mov in kernel, from that on is  bl Fac

 ;push onto the stack without changing the stack pointer
bl FACTORIAL      ;call FACTORIAL   r0 = 6  r1 = 2

EXIT:
pop {r1,lr}  ;pop off the stack
bx lr   ;RETURN
