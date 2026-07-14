## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Basic data leak prevention)
1(L2 AI usage policy)
2(L4 Automated data leak detection for AI interactions)
3(L4 Hallucination detection for AI responses)
4(L4 Secure output handling in AI applications)
5(L3 Input validation for AI systems)
6(L1 Context-aware output encoding)
7(L5 Protection of agent memory against poisoning)
8(L2 Inventory of AI agents)
9(L2 Language and framework specific security rules)
10(L1 Static load of security rules)
11(L2 Spec-driven development)
12(L1 Version control)
13(L2 Threat modeling rule)
14(L1 Conduction of simple threat modeling on technical level)
15(L3 Audit logging of AI agent actions)
16(L2 Centralized application logging)
17(L3 Decommissioning of AI agents)
18(L3 Least privilege on external systems for AI agents)
19(L3 Evaluation of the trust of used AI components)
20(L2 Evaluation of the trust of used components)
21(L3 Threat modeling of AI components)
22(L4 Anomaly detection for AI agent behavior)
23(L2 Alerting)
24(L4 Dynamic load of security rules)
25(L2 Rate limiting and resource budgets for AI systems)
26(L2 Monitoring of costs)
27(L2 Untrusted workspace handling for AI agents)
28(L1 Container-based isolation of AI agents)
29(L2 Permission management for AI agents)
30(L3 Network isolation for AI agents)
31(L4 Human approval for irreversible AI agent actions)
32(L4 Regular automated AI red teaming)
33(L3 Basic AI red teaming)
34(L1 Human review of AI generated specifications)
35(L2 Human review of AI generated plans)
36(L2 No verification bypass for AI generated code)
37(L1 Defined build process)
38(L3 Static analysis for important server side components)
39(L2 Simple Scan)
40(L2 Self-verification of AI generated changes)
41(L2 Security unit tests for important components)
42(L2 Static and dynamic analysis of AI generated code)
43(L2 Validation of AI-suggested dependencies)
44(L2 Software Composition Analysis server side)
45(L3 Human review of AI generated code)
46(L3 Security test generation with AI)
47(L4 Continuous detection of compromised AI components)
48(L3 Test for compromised components)
49(L5 Drift detection for agent instructions and guardrails)
50(L3 Drift detection for deployed configuration)
51(L2 Pinning of artifacts)
52(L2 SBOM of components)
53(L3 Signing of code)
54(L5 Signing of artifacts)
55(L1 Automated deployment process)
56(L1 Defined deployment process)
57(L1 Inventory of production components)
58(L2 Inventory of production artifacts)
59(L3 Handover of confidential parameters)
60(L2 Environment depending configuration parameters secrets)
61(L3 Inventory of production dependencies)
62(L3 Rolling update on deployment)
63(L4 Canary deployment)
64(L4 Same artifact for environments)
65(L4 Usage of feature toggles)
66(L5 Blue/Green Deployment)
67(L4 Smoke Test)
68(L2 Automated merge of automated PRs)
69(L1 Automated PRs for patches)
70(L3 Automated deployment of automated PRs)
71(L3 Creation of simple abuse stories)
72(L3 Creation of threat modeling processes and standards)
73(L4 Conduction of advanced threat modeling)
74(L5 Creation of advanced abuse stories)
75(L2 Regular security training of security champions)
76(L2 Each team has a security champion)
77(L2 Determining the protection requirement)
78(L2 App. Hardening Level 1)
79(L1 App. Hardening Level 1 50%)
80(L3 App. Hardening Level 2 75%)
81(L4 App. Hardening Level 2)
82(L5 App. Hardening Level 3)
83(L3 Block force pushes)
84(L2 Require a PR before merging)
85(L3 Dismiss stale PR approvals)
86(L3 Require status checks to pass)
87(L2 Backup)
88(L2 MFA)
89(L1 MFA for admins)
90(L2 Usage of test and production environments)
91(L2 Virtual environments are limited)
92(L2 Applications are running in virtualized environments)
93(L3 Immutable infrastructure)
94(L3 Infrastructure as Code)
95(L3 Limitation of system events)
96(L3 Audit of system events)
97(L3 Usage of security by default for components)
98(L3 WAF baseline)
99(L4 Production near environments are used by developers)
100(L4 WAF medium)
101(L5 WAF Advanced)
102(L3 Logging of AI interactions)
103(L3 Visualized logging)
104(L1 Centralized system logging)
105(L5 Correlation of security events)
106(L2 Visualized metrics)
107(L1 Simple application metrics)
108(L1 Simple system metrics)
109(L3 Advanced availability and stability metrics)
110(L3 Deactivation of unused metrics)
111(L3 Targeted alerting)
112(L4 Advanced app. metrics)
113(L4 Coverage and control metrics)
114(L4 Defense metrics)
115(L3 Filter outgoing traffic)
116(L4 Screens with metric visualization)
117(L3 Grouping of metrics)
118(L5 Metrics are combined with tests)
119(L2 Patching mean time to resolution via PR)
120(L3 Generation of response statistics)
121(L3 Usage of a vulnerability management system)
122(L4 Patching mean time to resolution via production)
123(L2 Artifact-based false positive treatment)
124(L1 Simple false positive treatment)
125(L3 Fix based on accessibility)
126(L1 Treatment of defects with high or critical severity)
127(L3 Global false positive treatment)
128(L2 Exploit likelihood estimation)
129(L3 Office Hours)
130(L2 Coverage of client side dynamic components)
131(L2 Usage of different roles)
132(L3 Coverage of hidden endpoints)
133(L3 Coverage of more input vectors)
134(L3 Coverage of sequential operations)
135(L4 Usage of multiple scanners)
136(L5 Coverage of service to service communication)
137(L2 Test for exposed services)
138(L2 Isolated networks for virtual environments)
139(L2 Test network segmentation)
140(L3 Test for unauthorized installation)
141(L2 Test for Time to Patch)
142(L2 Test libyear)
143(L3 API design validation)
144(L3 Software Composition Analysis client side)
145(L3 Static analysis for important client side components)
146(L3 Test for Patch Deployment Time)
147(L4 Static analysis for all self written components)
148(L4 Usage of multiple analyzers)
149(L5 Dead code elimination)
150(L5 Exclusion of source code duplicates)
151(L5 Static analysis for all components/libraries)
152(L4 Correlate known vulnerabilities in infrastructure with new image versions)
153(L2 Usage of a maximum lifetime for images)
154(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 8
1 --> 19
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 98
10 --> 9
10 --> 24
11 --> 9
11 --> 13
11 --> 24
11 --> 34
11 --> 35
12 --> 11
12 --> 56
14 --> 13
14 --> 21
14 --> 71
14 --> 72
14 --> 73
8 --> 15
8 --> 17
16 --> 15
16 --> 102
16 --> 103
18 --> 17
18 --> 45
20 --> 19
20 --> 140
15 --> 22
15 --> 31
23 --> 22
23 --> 25
23 --> 16
23 --> 105
23 --> 111
13 --> 24
13 --> 46
26 --> 25
28 --> 27
28 --> 30
29 --> 18
29 --> 31
33 --> 32
34 --> 35
37 --> 36
37 --> 40
37 --> 51
37 --> 52
37 --> 53
37 --> 54
37 --> 55
37 --> 56
37 --> 64
37 --> 97
37 --> 39
37 --> 44
37 --> 142
37 --> 144
37 --> 145
37 --> 38
37 --> 146
37 --> 48
37 --> 149
37 --> 150
38 --> 36
38 --> 42
38 --> 147
38 --> 151
39 --> 36
39 --> 42
39 --> 131
39 --> 136
41 --> 40
44 --> 43
44 --> 128
44 --> 48
44 --> 148
45 --> 46
19 --> 47
48 --> 47
7 --> 49
50 --> 49
51 --> 54
56 --> 55
56 --> 87
56 --> 90
55 --> 57
55 --> 58
55 --> 50
55 --> 62
55 --> 63
55 --> 99
55 --> 67
57 --> 58
57 --> 77
57 --> 125
57 --> 44
57 --> 143
57 --> 144
57 --> 145
57 --> 38
57 --> 147
57 --> 151
60 --> 59
58 --> 61
52 --> 61
64 --> 65
67 --> 66
69 --> 68
69 --> 119
69 --> 122
69 --> 141
69 --> 146
68 --> 70
72 --> 71
72 --> 73
71 --> 74
76 --> 75
76 --> 121
79 --> 78
78 --> 80
80 --> 81
81 --> 82
84 --> 83
84 --> 85
84 --> 86
89 --> 88
92 --> 91
94 --> 93
94 --> 99
96 --> 95
98 --> 100
100 --> 101
104 --> 103
103 --> 105
106 --> 23
106 --> 109
106 --> 96
106 --> 110
106 --> 112
106 --> 113
106 --> 114
107 --> 26
107 --> 106
107 --> 109
107 --> 112
108 --> 26
108 --> 106
115 --> 114
117 --> 116
117 --> 118
121 --> 120
121 --> 127
119 --> 122
124 --> 123
126 --> 125
123 --> 127
128 --> 121
128 --> 144
129 --> 121
131 --> 130
131 --> 132
131 --> 133
131 --> 134
131 --> 135
138 --> 137
138 --> 139
145 --> 147
145 --> 151
144 --> 148
147 --> 148
153 --> 152
153 --> 154

O --> 1
O --> 5
O --> 6
O --> 10
O --> 12
O --> 14
O --> 20
O --> 28
O --> 29
O --> 33
O --> 37
O --> 41
O --> 60
O --> 69
O --> 76
O --> 79
O --> 84
O --> 89
O --> 92
O --> 94
O --> 104
O --> 107
O --> 108
O --> 115
O --> 117
O --> 124
O --> 126
O --> 129
O --> 138
O --> 153
```
