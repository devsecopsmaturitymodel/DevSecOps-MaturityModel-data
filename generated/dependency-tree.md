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
8(L2 Instructed load of security rules)
9(L1 Static load of security rules)
10(L2 Spec-driven development)
11(L2 Inventory of AI agents)
12(L2 Language and framework specific security rules)
13(L1 Version control)
14(L2 Threat modeling rule)
15(L1 Conduction of simple threat modeling on technical level)
16(L3 Audit logging of AI agent actions)
17(L2 Centralized application logging)
18(L3 Decommissioning of AI agents)
19(L3 Least privilege on external systems for AI agents)
20(L3 Evaluation of the trust of used AI components)
21(L2 Evaluation of the trust of used components)
22(L3 Threat modeling of AI components)
23(L4 Anomaly detection for AI agent behavior)
24(L2 Alerting)
25(L4 Dynamic load of security rules)
26(L5 Automated containment of anomalous AI agents)
27(L2 Rate limiting and resource budgets for AI systems)
28(L2 Monitoring of costs)
29(L2 Untrusted workspace handling for AI agents)
30(L1 Usage of sandboxing for AI agents)
31(L2 Permission management for AI agents)
32(L3 Network isolation for AI agents)
33(L4 Human approval for irreversible AI agent actions)
34(L4 Trust boundaries between AI agents)
35(L4 Regular automated AI red teaming)
36(L3 Basic AI red teaming)
37(L2 Human review of AI generated plans)
38(L2 Human review of AI generated specifications)
39(L2 Self-verification of AI generated changes)
40(L1 Defined build process)
41(L2 Security unit tests for important components)
42(L2 Static and dynamic analysis of AI generated code)
43(L3 Static analysis for important server side components)
44(L2 Simple Scan)
45(L2 Validation of AI-suggested dependencies)
46(L2 Software Composition Analysis server side)
47(L3 Human review of AI generated code)
48(L3 No verification bypass for AI generated code)
49(L3 Security test generation with AI)
50(L4 Continuous detection of compromised AI components)
51(L3 Test for compromised components)
52(L5 Drift detection for agent instructions and guardrails)
53(L3 Drift detection for deployed configuration)
54(L2 Building and testing of artifacts in virtualized environments)
55(L2 Usage of containers)
56(L2 Pinning of artifacts)
57(L2 SBOM of components)
58(L3 Signing of code)
59(L5 Signing of artifacts)
60(L1 Automated deployment process)
61(L1 Defined deployment process)
62(L1 Inventory of production components)
63(L2 Inventory of production artifacts)
64(L3 Handover of confidential parameters)
65(L2 Environment depending configuration parameters secrets)
66(L3 Inventory of production dependencies)
67(L3 Rolling update on deployment)
68(L4 Canary deployment)
69(L4 Same artifact for environments)
70(L4 Usage of feature toggles)
71(L5 Blue/Green Deployment)
72(L4 Smoke Test)
73(L2 Automated merge of automated PRs)
74(L1 Automated PRs for patches)
75(L3 Automated deployment of automated PRs)
76(L3 Creation of simple abuse stories)
77(L3 Creation of threat modeling processes and standards)
78(L4 Conduction of advanced threat modeling)
79(L5 Creation of advanced abuse stories)
80(L2 Regular security training of security champions)
81(L2 Each team has a security champion)
82(L2 Determining the protection requirement)
83(L2 App. Hardening Level 1)
84(L1 App. Hardening Level 1 50%)
85(L3 App. Hardening Level 2 75%)
86(L4 App. Hardening Level 2)
87(L5 App. Hardening Level 3)
88(L3 Block force pushes)
89(L2 Require a PR before merging)
90(L3 Dismiss stale PR approvals)
91(L3 Require status checks to pass)
92(L2 Backup)
93(L2 MFA)
94(L1 MFA for admins)
95(L2 Usage of test and production environments)
96(L2 Virtual environments are limited)
97(L3 Immutable infrastructure)
98(L3 Infrastructure as Code)
99(L3 Limitation of system events)
100(L3 Audit of system events)
101(L3 Usage of security by default for components)
102(L3 WAF baseline)
103(L4 Production near environments are used by developers)
104(L4 WAF medium)
105(L5 WAF Advanced)
106(L3 Logging of AI interactions)
107(L3 Visualized logging)
108(L1 Centralized system logging)
109(L5 Correlation of security events)
110(L2 Visualized metrics)
111(L1 Simple application metrics)
112(L1 Simple system metrics)
113(L3 Advanced availability and stability metrics)
114(L3 Deactivation of unused metrics)
115(L3 Targeted alerting)
116(L4 Advanced app. metrics)
117(L4 Coverage and control metrics)
118(L4 Defense metrics)
119(L3 Filter outgoing traffic)
120(L4 Screens with metric visualization)
121(L3 Grouping of metrics)
122(L5 Metrics are combined with tests)
123(L2 Patching mean time to resolution via PR)
124(L3 Generation of response statistics)
125(L3 Usage of a vulnerability management system)
126(L4 Patching mean time to resolution via production)
127(L2 Artifact-based false positive treatment)
128(L1 Simple false positive treatment)
129(L3 Fix based on accessibility)
130(L1 Treatment of defects with high or critical severity)
131(L3 Global false positive treatment)
132(L2 Exploit likelihood estimation)
133(L3 Office Hours)
134(L2 Coverage of client side dynamic components)
135(L2 Usage of different roles)
136(L3 Coverage of hidden endpoints)
137(L3 Coverage of more input vectors)
138(L3 Coverage of sequential operations)
139(L4 Usage of multiple scanners)
140(L5 Coverage of service to service communication)
141(L2 Test for exposed services)
142(L2 Isolated networks for virtual environments)
143(L2 Test network segmentation)
144(L3 Test for unauthorized installation)
145(L2 Test for Time to Patch)
146(L2 Test libyear)
147(L3 API design validation)
148(L3 Software Composition Analysis client side)
149(L3 Static analysis for important client side components)
150(L3 Test for Patch Deployment Time)
151(L4 Static analysis for all self written components)
152(L4 Usage of multiple analyzers)
153(L5 Dead code elimination)
154(L5 Exclusion of source code duplicates)
155(L5 Static analysis for all components/libraries)
156(L4 Correlate known vulnerabilities in infrastructure with new image versions)
157(L2 Usage of a maximum lifetime for images)
158(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 11
1 --> 20
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 102
9 --> 8
9 --> 12
9 --> 25
10 --> 8
10 --> 12
10 --> 14
10 --> 25
10 --> 37
10 --> 38
13 --> 10
13 --> 61
15 --> 14
15 --> 22
15 --> 76
15 --> 77
15 --> 78
11 --> 16
11 --> 18
17 --> 16
17 --> 106
17 --> 107
19 --> 18
19 --> 26
19 --> 34
19 --> 47
21 --> 20
21 --> 144
16 --> 23
16 --> 33
16 --> 34
24 --> 23
24 --> 27
24 --> 17
24 --> 109
24 --> 115
14 --> 25
14 --> 49
8 --> 25
23 --> 26
28 --> 27
30 --> 29
30 --> 32
31 --> 19
31 --> 33
36 --> 35
38 --> 37
40 --> 39
40 --> 48
40 --> 56
40 --> 57
40 --> 58
40 --> 59
40 --> 60
40 --> 61
40 --> 69
40 --> 101
40 --> 44
40 --> 46
40 --> 146
40 --> 148
40 --> 149
40 --> 43
40 --> 150
40 --> 51
40 --> 153
40 --> 154
41 --> 39
43 --> 42
43 --> 48
43 --> 151
43 --> 155
44 --> 42
44 --> 48
44 --> 135
44 --> 140
46 --> 45
46 --> 132
46 --> 51
46 --> 152
47 --> 49
20 --> 50
51 --> 50
7 --> 52
53 --> 52
55 --> 54
55 --> 96
56 --> 59
61 --> 60
61 --> 92
61 --> 95
60 --> 62
60 --> 63
60 --> 53
60 --> 67
60 --> 68
60 --> 103
60 --> 72
62 --> 63
62 --> 82
62 --> 129
62 --> 46
62 --> 147
62 --> 148
62 --> 149
62 --> 43
62 --> 151
62 --> 155
65 --> 64
63 --> 66
57 --> 66
69 --> 70
72 --> 71
74 --> 73
74 --> 123
74 --> 126
74 --> 145
74 --> 150
73 --> 75
77 --> 76
77 --> 78
76 --> 79
81 --> 80
81 --> 125
84 --> 83
83 --> 85
85 --> 86
86 --> 87
89 --> 88
89 --> 90
89 --> 91
94 --> 93
98 --> 97
98 --> 103
100 --> 99
102 --> 104
102 --> 105
108 --> 107
107 --> 109
110 --> 24
110 --> 113
110 --> 100
110 --> 114
110 --> 116
110 --> 117
110 --> 118
111 --> 28
111 --> 110
111 --> 113
111 --> 116
112 --> 28
112 --> 110
119 --> 118
121 --> 120
121 --> 122
125 --> 124
125 --> 131
123 --> 126
128 --> 127
130 --> 129
127 --> 131
132 --> 125
132 --> 148
133 --> 125
135 --> 134
135 --> 136
135 --> 137
135 --> 138
135 --> 139
142 --> 141
142 --> 143
149 --> 151
149 --> 155
148 --> 152
151 --> 152
157 --> 156
157 --> 158

O --> 1
O --> 5
O --> 6
O --> 9
O --> 13
O --> 15
O --> 21
O --> 30
O --> 31
O --> 36
O --> 40
O --> 41
O --> 55
O --> 65
O --> 74
O --> 81
O --> 84
O --> 89
O --> 94
O --> 98
O --> 108
O --> 111
O --> 112
O --> 119
O --> 121
O --> 128
O --> 130
O --> 133
O --> 142
O --> 157
```
