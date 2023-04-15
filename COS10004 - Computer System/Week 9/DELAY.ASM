Delay:
TIMER_OFFSET = $3000
mov r3,r0
orr r3, TIMER_OFFSET
mov r4,r1

ldrd r6,r7, [r3,#4]
mov r5,r6

loop1:
 ldrd r6,r7,[r3,#4]
 sub r8,r6,r5
 cmp r8,r4
 bls loop1

bx lr